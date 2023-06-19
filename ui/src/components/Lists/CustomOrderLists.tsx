import { JSXElementConstructor, ReactElement, ReactFragment, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import Checkbox  from "../Checkbox";
import RadioButtonGroup from 'components/inputs/RadioButtonGroup';

export function CustomOrderLists({ingredients, handlePriceChange}) {
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);
    const [selectedMeasure, setSelectedMeasure] = useState(0);
    let electricFee = 10;

    const [selectedValue, setSelectedValue] = useState<String>(ingredients[0].id);

    function radioGroupHandler(event: React.ChangeEvent<HTMLInputElement>) {
        setSelectedValue(event.target.value);
    }

    // This function will be triggered when a radio button is selected
    const radioHandler = (event: React.ChangeEvent<HTMLInputElement>, item) => {
        setSelectedMeasure(parseInt(event.target.value));
        measurements.map((measurement, idx) => {
            if(measurement?.id === selectedMeasure) {
                console.log('selected: ', measurement);
                console.log('ingredients: ', item);
                handlePriceChange(measurement?.price);
            }
        })
        // compute also the toal
    };

    useEffect(() => {
        console.log(selectedValue);
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

    var product = types.map((type, idx) => {
        return (
            <li key={idx} style={{height:'auto',padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p style={{textAlign:'left',marginTop:'2rem'}}><strong>{type?.name}</strong></p>
                <ul>
                    {
                        ingredients.map((item, idx) => {
                            if(item.types_id == type.id) {
                                return(
                                    <li key={idx}>
                                        <p style={{textAlign:'left',marginTop:'1rem'}}><strong>{item.name}:</strong><span>{parseInt(item.measurement)} {item.unit}</span></p>
                                        <div>
                                            { 
                                                <RadioButtonGroup
                                                    label="Select your measurement:"
                                                    options={measurements}
                                                    onChange={radioGroupHandler}
                                                />
                                                // measurements.map((measure, index) => {
                                                //     return(
                                                //         <div key={index} style={{display:'flex',alignItems:'center',marginTop:'1rem',marginBottom:'1rem'}}>
                                                //             <input style={{display:'inline-block',width:'20px',marginRight:10}}
                                                //                 id={item?.id + '_' + measure?.id}
                                                //                 name={item?.id}
                                                //                 type="radio"
                                                //                 value={measure?.id}
                                                //                 onChange={(e) => {
                                                //                     radioHandler(e, item);
                                                //                 }}
                                                //             />
                                                //             <label style={{width:'40%',textAlign:'left'}} htmlFor={item?.id + '_' + measure?.id}>{measure?.name}</label>
                                                //             <p style={{width:'50%',textAlign:'right',display:'inline-block'}}>Php {measure?.price}</p>
                                                //         </div>
                                                //     )
                                                // })
                                            }
                                        </div>
                                    </li>
                                )
                            } else {
                                return ('')
                            }
                        })
                    }
                </ul>
            </li>
        );
    })

    return(
        <ul>
            <li style={{padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p style={{display:'flex', justifyContent:'space-evenly', alignItems:'center',height:'50%'}}>
                    <span style={{textAlign:'left',width:'50%'}}><strong>Cup Size</strong></span>
                    <span style={{textAlign:'right',width:'50%'}}>16 oz.</span>
                </p>
            </li>
            { product }
        </ul>
    )
}