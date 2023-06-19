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
                <p style={{fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginTop:'2rem'}}><strong>{type?.name}</strong></p>
                <ul>
                    {
                        ingredients.map((item, idx) => {
                            if(item.types_id == type.id) {
                                return(
                                    <li key={idx}>
                                        <p style={{fontSize:'large',fontWeight:'bolder',textAlign:'left',marginTop:'1rem'}}><strong>{item.name}:</strong><span>{parseInt(item.measurement)} {item.unit}</span></p>
                                        <RadioButtonGroup
                                            label=""
                                            group={item?.name}
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
                <p>
                    <span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}><strong>Note: </strong> Cup size available is 16 oz. only.</span>
                </p>
            </li>
            { product }
        </ul>
    )
}