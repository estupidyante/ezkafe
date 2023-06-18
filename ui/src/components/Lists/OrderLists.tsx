import { useEffect, useState, } from 'react';
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

    var ingredient = types.map(function(type, idx){
        console.log(type);
        return (
            <li key={idx} style={{height:80,padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p style={{textAlign:'left',marginTop:'2rem'}}><strong>{type?.name}</strong></p>
                <ul>
                    {
                        type?.ingredients.map((item, idx) => {
                            return(
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
                                <p style={{textAlign:'right',width:'100%',height:'50%'}}>{item.measurement} {item.unit}</p>
                            </li>
                            )
                        })
                    }
                </ul>
            </li>
        );
    })
    // var ingredient = ingredients.map(function(item, idx){
    //     return (
    //         <li key={idx} style={{height:80,padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
    //             <p style={{display:'flex', justifyContent:'space-evenly', alignItems:'center',height:'50%'}}>
    //             {
    //                     types?.map((type, i) => {
    //                         if (item.types_id == type?.id) return(<span key={i} style={{textAlign:'left',width:'50%'}}><strong>{type?.name}</strong></span>)
    //                         else return('')
    //                     })
    //                 }
    //                 <span style={{textAlign:'right',width:'50%'}}>{item.name}</span>
    //             </p>
    //             <p style={{textAlign:'right',width:'100%',height:'50%'}}>{item.measurement} {item.unit}</p>
    //         </li>
    //     );
    // })
    return(
        <ul>
            <li style={{padding:'1rem',borderBottomColor:'#26140D',borderBottomStyle:'solid',borderBottomWidth:1,}}>
                <p style={{display:'flex', justifyContent:'space-evenly', alignItems:'center',height:'50%'}}>
                    <span style={{textAlign:'left',width:'50%'}}><strong>Cup Size</strong></span>
                    <span style={{textAlign:'right',width:'50%'}}>16 oz.</span>
                </p>
            </li>
            { ingredient }
        </ul>
    )
}