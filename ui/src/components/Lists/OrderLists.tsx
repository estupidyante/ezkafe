import { JSXElementConstructor, ReactElement, ReactFragment, useEffect, useState, } from 'react';
import {
    API,
} from '../../api';

export function OrderLists({ingredients}) {
    const [types, setTypes] = useState(Array);

    useEffect(() => {
        API.get('types')
            .then((res) => {
                setTypes(res);
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
                                        <p style={{textAlign:'left',marginTop:'1rem'}}>{item.name}: {parseInt(item.measurement)} {item.unit}</p>
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