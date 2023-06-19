import { useEffect, useState, } from 'react';
import {
    API,
} from '../../api';

export function ProductIngredientLists({ingredients}) {
    const [types, setTypes] = useState(Array);
    useEffect(() => {
        API.get('types')
            .then((res) => {
                setTypes(res);
            })
    }, []);

    var ingredient = ingredients.map((item, idx) => {
        return (
            <li key={idx} style={{height:80,padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p style={{display:'flex', justifyContent:'space-evenly', alignItems:'center',height:'50%'}}>
                    {
                        types?.map((type, i) => {
                            if (item.types_id == type?.id) return(<span key={i} style={{textAlign:'left',width:'50%'}}><strong>{type?.name}</strong></span>)
                            else return('')
                        })
                    }
                    <span style={{textAlign:'right',width:'50%'}}>{item.name}</span>
                </p>
                {
                    types?.map((type, i) => {
                        if (item.types_id == type?.id) return(<p key={i} style={{textAlign:'right',width:'100%',height:'50%'}}>{type?.measurement} {type?.unit}</p>)
                        else return('')
                    })
                }
            </li>
        );
    })
    return(
        <ul>{ ingredient }</ul>
    )
}