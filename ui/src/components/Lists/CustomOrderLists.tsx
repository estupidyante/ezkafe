import { JSXElementConstructor, ReactElement, ReactFragment, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';
import Checkbox  from "../Checkbox";
import RadioButtonGroup from 'components/inputs/RadioButtonGroup';

export function CustomOrderLists({product,ingredients, handlePriceChange}) {
    const [types, setTypes] = useState(Array);
    const [measurements, setMeasurements] = useState(Array);
    const [selectedValue, setSelectedValue] = useState<String>();

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
            })
        console.log('product: ',product);
    }, []);

    var productBase = types.map((type, idx) => {
        return(
            <div key={idx} style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                <p style={{fontSize:'x-large',fontWeight:'bolder',textAlign:'left',}}>{type?.name}</p>
                <p style={{marginBottom:20}}><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}>Fixed according to the combo selected. </span></p>
                {
                    <RadioButtonGroup
                        label=""
                        group={type?.name}
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
                <p><span style={{fontSize:'small',fontWeight:'bolder',textAlign:'left'}}><strong>Note: </strong> Cup size available is 16 oz. only.</span></p>
            </li>
            <li>
                { productBase }
            </li>
        </ul>
    )
}