import { useCallback, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import RadioButtonGroup from 'components/Radio/RadioButtonGroup';
import React from 'react';
import CurrentProducts from 'components/Products/CurrentProducts';

export function CustomOrderLists({product, ingredients, handlePriceChange, handleCustomProduct}) {
    const [, updateState] = useState();
    const forceUpdate = useCallback(() => updateState({}), []);
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);
    const [selectedValue, setSelectedValue] = useState<String>();
    const [isBaseAdded, setIsBaseAdded] = useState(false);
    const [isSweetenerAdded, setIsSweetenerAdded] = useState(false);
    const [isBaseSelected, setIsBaseSelected] = useState(false);
    const [isSweetenerSelected, setIsSweetenerSelected] = useState(false);
    const [isMeasurementSelected, setIsMeasurementSelected] = useState(false);
    const [selectedNewIng, setSelectedNewIng] = useState(Array);
    const [selectedNewMeasure, setSelectedNewMeasure] = useState(Array);

    const [productTypes, setProductTypes] = useState(Array);
    const [productIngredients, setProductIngredients] = useState(Array);
    const [productMeasurement, setProductMeasurement] = useState(Array);

    const [customProduct, setCustomProduct] = useState(Array);

    let tempProductIng = [];
    let tempProductMeasure = [];
    let tempProductIngSelected: string;
    let tempProductMeasureSelected: string;

    function radioGroupHandler(event: React.ChangeEvent<HTMLInputElement>) {
        setSelectedValue(event.target.value);
        let selectedIng = event.target.value;
        let selectedIngArr = selectedIng.split('_');
        if((isBaseAdded && !isBaseSelected) || (isSweetenerAdded && !isSweetenerSelected)) {
            let ing = ingredients.filter((ing: {id: any}) => {
                return ing.id == selectedIngArr[1];
            });
            console.log('isBaseAdded', ing);
            tempProductIngSelected = selectedIngArr[1];
            setSelectedNewIng(ing);
            if(isBaseAdded && !isSweetenerAdded) { setIsBaseSelected(true); }
            else { setIsSweetenerSelected(true) }
        }

        if (isBaseSelected || isSweetenerSelected) {
            let measurement = measurements.filter((measure: {id: any}) => {
                return measure.id == selectedIngArr[1];
            });
            console.log(measurement);
            tempProductMeasureSelected = selectedIngArr[1];
            setSelectedNewMeasure(measurement);
            setIsMeasurementSelected(true);
        }
    }

    useEffect(() => {
        console.log('customProduct:', customProduct);
        forceUpdate();
    }, [productIngredients, productMeasurement, customProduct, productTypes]);


    useEffect(() => {
        API.get('types')
            .then((res_type) => {
                setTypes(res_type);
                setProductTypes(res_type);
            })
        API.get('measurements')
            .then((res_measure) => {
                setMeasurements(res_measure);
            })
        setProductIngredients(product.ingredients);
        setCustomProduct(product);
        tempProductIng =  product.ing_ids;
        tempProductMeasure = product.measurement_ids;

        product.ingredients.map((ing: { price: any; }) => {
            console.log('price tracker', ing);
            handlePriceChange(ing.price);
        })
    }, []);

    const listenChange = useCallback((selected: string) => {
        console.log('callback: ', selected);
        forceUpdate();
    }, []);

    const childCurrentProducts = <CurrentProducts key={undefined} types={productTypes} ingredients={productIngredients} measurement={productMeasurement} handleChange={listenChange} />;

    return(
        <div>
            <ul>
                <li style={{padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                    <p><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}><strong>Note: </strong> Cup size available is 12 oz. only.</span></p>
                </li>
                <li>
                    { childCurrentProducts }
                </li>
            </ul>
        </div>
    )
}

const styles = theme => ({
    disabledButton: {
      backgroundColor: theme.palette.primary || 'red'
    }
});