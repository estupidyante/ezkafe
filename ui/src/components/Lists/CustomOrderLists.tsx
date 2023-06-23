import { JSXElementConstructor, ReactElement, ReactFragment, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import RadioButtonGroup from 'components/Radio/RadioButtonGroup';
import React from 'react';

export function CustomOrderLists(this: any, {product, ingredients, handlePriceChange, handleCustomProduct}) {
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);
    const [selectedValue, setSelectedValue] = useState<String>();
    const [isBaseAdded, setIsBaseAdded] = useState(false);
    const [isSweetenerAdded, setIsSweetenerAdded] = useState(false);

    const [isBaseSelected, setIsBaseSelected] = useState(false);
    const [selectedNewIng, setSelectedNewIng] = useState(Array);
    const [selectedNewMeasure, setSelectedNewMeasure] = useState(Array);

    function radioGroupHandler(event: React.ChangeEvent<HTMLInputElement>) {
        setSelectedValue(event.target.value);
        let selectedIng = event.target.value;
        let selectedIngArr = selectedIng.split('_');
        console.log(selectedIngArr);
        if(isBaseAdded) {
            let ing = ingredients.filter((ing: {id: any}) => {
                return ing.id == selectedIngArr[1];
            });
            console.log(ing);
            setSelectedNewIng(ing);
            setIsBaseSelected(true);
        }

        if (isBaseSelected) {
            let measurement = measurements.filter((measure: {id: any}) => {
                return measure.id == selectedIngArr[1];
            });
            console.log(measurement);
            setSelectedNewMeasure(measurement);
        }
        // product.ing_ids = product.ing_ids + ',' + ing[0].id;

        // display measurements and save button
    }

    useEffect(() => {
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

    const currentProduct = product.ingredients.map((ingredient, idx) => {
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
                {/* {
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
                } */}
            </div>
        )
    });

    // const selectedElement = (() => {
    //     return(
    //         <li><div style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}><p style={{fontSize:'x-large',fontWeight:'bolder',textAlign:'left',display:'flex',justifyContent:'space-between',}}><span>{types.map((type, i) => {if (type.id == selectedNewIng[0].types_id) return type.name})}</span><span>{selectedNewIng[0]?.name}</span></p><p style={{marginBottom:20,textAlign:'right'}}>{ selectedNewMeasure[0].value } { selectedNewMeasure.unit }</p></div></li>
    //     )
    // })

    const addNewBase = (() => {
        console.log('add new base');
        setIsBaseAdded(true);
    })

    const cancelNewBase = (() => {
        console.log('cancel new base');
        setIsBaseAdded(false);
        setIsBaseSelected(false);
    })

    const addNewSweetener = (() => {
        console.log('add new sweetener');
        setIsSweetenerAdded(true);
    })

    const saveSelected = (() => {
        console.log(product);
        console.log(selectedNewIng);
        console.log(selectedNewMeasure);
    })

    return(
        <div>
            <p style={{marginBottom:20}}><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}>Fixed according to the combo selected. </span></p>
            <ul id="productIngredients">
                <li style={{padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                    <p><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}><strong>Note: </strong> Cup size available is 12 oz. only.</span></p>
                </li>
                <li>
                    { currentProduct }
                </li>
            </ul>
            {!isBaseAdded && <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#97C361', color: '#000000', borderRadius: 10,marginTop:'5rem'}} onClick={() => {
                addNewBase();
            }}>
                Add Base
            </button>}
            { isBaseAdded && <div style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#97C361', color: '#000000', borderRadius: 10,marginTop:'4rem',marginBottom:'2rem'}} onClick={() => {
                    cancelNewBase();
                }}>
                    Cancel Base
                </button>
                {
                    <RadioButtonGroup
                        label=""
                        group={'base'}
                        ing={product.name}
                        prod_id={product.id}
                        options={
                            ingredients.filter((ing: {
                                category_id: any; types_id: any; 
                            }) => {
                                return ((ing.types_id === 1) && (ing.category_id === product.category_id));
                            })
                        }
                        onChange={radioGroupHandler}
                    />
                }
            </div> }
            { isBaseSelected && <div style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                {
                    <RadioButtonGroup
                        label=""
                        group={'base_measurement'}
                        ing={product.name}
                        prod_id={product.id}
                        options={measurements}
                        onChange={radioGroupHandler}
                    />
                }
                <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'2rem'}} onClick={() => {
                    saveSelected();
                }}>
                    Save Base
                </button>
            </div> }
            <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#97C361', color: '#000000', borderRadius: 10,marginTop:'2rem'}} onClick={() => {
                addNewSweetener();
            }}>
                Add Sweetener
            </button>
            { isSweetenerAdded && <div style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                {
                    <RadioButtonGroup
                        label=""
                        group={'sweetener'}
                        ing={product.name}
                        prod_id={product.id}
                        options={
                            ingredients.filter((ing: {
                                category_id: any; types_id: any; 
                            }) => {
                                return ((ing.types_id === 2) && (ing.category_id === product.category_id));
                            })
                        }
                        onChange={radioGroupHandler}
                    />
                }
            </div> }
        </div>
    )
}