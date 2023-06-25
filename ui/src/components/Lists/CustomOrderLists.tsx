import { useCallback, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import CurrentProducts from 'components/Products/CurrentProducts';

export function CustomOrderLists({product, handlePriceChange, handleCustomProduct}) {
    const [, updateState] = useState();
    const forceUpdate = useCallback(() => updateState({}), []);
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);

    const [productTypes, setProductTypes] = useState(Array);
    const [productIngredients, setProductIngredients] = useState(Array);
    const [productMeasurement, setProductMeasurement] = useState(Array);

    const [selectedProductIngredients, setSelectedProductIngredients] = useState(Array);
    const [selectedProductMeasurement, setSelectedProductMeasurement] = useState(Array);

    const [customProduct, setCustomProduct] = useState(Array);

    let tempProductIng = [];
    let tempProductMeasure = [];


    useEffect(() => {
        API.get('types')
            .then((res_type) => {
                setTypes(res_type);
                setProductTypes(res_type);
            })
        API.get('measurements')
            .then((res_measure) => {
                console.log('res_measure: ', res_measure);
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
        // get the measurements and what ingredients
        let selectedMeasurementArr = selected.split('_');
        let measurement = measurements.filter((measure:any) => {
            return measure.id == parseInt(selectedMeasurementArr[1]);
        });
        console.log('measurement: ', measurement[0]);
        let ingredient = productIngredients.filter((ing:any) => {
            return ing.id == parseInt(selectedMeasurementArr[0]);
        });
        console.log('ingredient: ',ingredient[0]);
        console.log('productIngredients: ', productIngredients);
        if((measurement && ingredient) && (measurement[0] && ingredient[0])) {
            var foundIndex = productIngredients.findIndex((x:any) => x.id == ingredient[0].id);
            productIngredients[foundIndex].measurement = measurement[0].value;
            productIngredients[foundIndex].measurements_id = measurement[0].id;
            productIngredients[foundIndex].price = measurement[0].price;
            productIngredients[foundIndex].unit = measurement[0].unit;
        }
        let tempMeasurementIDs = '';
        productIngredients.map((ingredient:any) => {
            tempMeasurementIDs = (tempMeasurementIDs) ? tempMeasurementIDs + ',' + ingredient.measurements_id : ingredient.measurements_id;
        });
        console.log('productIngredients:', productIngredients);
        product.measurement_ids = tempMeasurementIDs;
        console.log(product);
        handleCustomProduct(product);

        forceUpdate();
    }, [measurements]);

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

