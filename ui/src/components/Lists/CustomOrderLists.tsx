import { JSXElementConstructor, ReactElement, ReactFragment, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import Checkbox  from "../Checkbox";
import RadioButtonGroup from 'components/inputs/RadioButtonGroup';

export function CustomOrderLists({ingredients, handlePriceChange}) {
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);

    const [selectedValue, setSelectedValue] = useState<String>(ingredients[0].id);

    function radioGroupHandler(event: React.ChangeEvent<HTMLInputElement>) {
        setSelectedValue(event.target.value);
    }

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
                // console.log(res_measure);
            })
    }, []);

    var product = types.map((type, idx) => {
        return (
            <li key={idx} style={{height:'auto',padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p style={{textAlign:'left',marginTop:'2rem'}}><strong>{type?.name}</strong></p>
                <RadioButtonGroup
                    label=""
                    options={measurements}
                    onChange={radioGroupHandler}
                />
                <ul>
                    {
                        ingredients.map((item, idx) => {
                            console.log(item);
                            if(item.types_id == type.id) {
                                return(
                                    <li key={idx}>
                                        <p style={{textAlign:'left',marginTop:'1rem'}}><strong>{item.name}:</strong><span>{parseInt(item.measurement)} {item.unit}</span></p>
                                        <RadioButtonGroup
                                            label=""
                                            name={item.name}
                                            options={measurements}
                                            onChange={radioGroupHandler}
                                        />
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