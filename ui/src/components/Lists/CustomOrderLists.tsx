import { JSXElementConstructor, ReactElement, ReactFragment, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import RadioButtonGroup from 'components/Radio/RadioButtonGroup';

export function CustomOrderLists({product, ingredients, handlePriceChange, handleCustomProduct}) {
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);
    const [selectedValue, setSelectedValue] = useState<String>();

    function radioGroupHandler(event: React.ChangeEvent<HTMLInputElement>) {
        setSelectedValue(event.target.value);
        let selectedIng = event.target.value;
        let selectedIngArr = selectedIng.split('_');
        let ing = ingredients.filter((ing: {id: any}) => {
            return ing.id == selectedIngArr[1];
        });
        console.log(ing);
    }

    useEffect(() => {
        // console.log(selectedValue);
        handleCustomProduct(selectedValue);
    }, [selectedValue]);

    useEffect(() => {
        API.get('types')
            .then((res_type) => {
                setTypes(res_type);
            })
        API.get('measurements')
            .then((res_measure) => {
                setMeasurements(res_measure);
            })
    }, []);

    var currentProduct = product.ingredients.map((ingredient, idx) => {
        return(
            <div key={idx} style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                <p style={{fontSize:'x-large',fontWeight:'bolder',textAlign:'left',display:'flex',justifyContent:'space-between',}}>
                    <span>
                        {
                            types.map((type, i) => {
                                if (type.id == ingredient.types_id) return type.name
                            })
                        }
                    </span>
                    <span>{ingredient?.name}</span>
                </p>
                <p style={{marginBottom:20,textAlign:'right'}}>{ ingredient.measurement } { ingredient.unit }</p>
                {
                    types.map((type, idx) => {
                        if(type?.id === ingredient.types_id) {
                            return(
                                <RadioButtonGroup
                                    key={idx}
                                    label=""
                                    group={ingredient?.name}
                                    ing={ingredient?.name}
                                    prod_id={product.id}
                                    options={
                                        ingredients.filter((ing: {
                                            category_id: any; types_id: any; 
                                        }) => {
                                            return ((ing.types_id === ingredient.types_id) && (ing.category_id === product.category_id));
                                        })
                                    }
                                    onChange={radioGroupHandler}
                                />
                            )
                        }
                    })
                }
            </div>
        )
    });

    var productBase = types.map((type, idx) => {
        return(
            <div key={idx} style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                <p style={{fontSize:'x-large',fontWeight:'bolder',textAlign:'left',}}>{type?.name}</p>
                <p style={{marginBottom:20}}><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}>Fixed according to the combo selected. </span></p>
                {
                    <RadioButtonGroup
                        label=""
                        group={type?.name}
                        ing={type?.name}
                        options={
                            ingredients.filter((ing: { types_id: any; }) => {
                                return ing.types_id === type?.id;
                            })
                        }
                        onChange={radioGroupHandler}
                    />
                }
            </div>
        )
    })

    return(
        <ul>
            <li style={{padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}><strong>Note: </strong> Cup size available is 12 oz. only.</span></p>
            </li>
            <li>
                { currentProduct }
            </li>
        </ul>
    )
}