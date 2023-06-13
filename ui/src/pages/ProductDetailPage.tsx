import { useEffect, useState } from 'react';
import styled, { keyframes } from 'styled-components';
import { 
    CloseOutline,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';

export const ProductDetailPage = ({product, state, handleState}) => {
    const [ingredients, setIngredients] = useState([]);
    let tempIng = [];

    useEffect(() => {
        product?.ing_ids.split(',').map((item, i) => {
            API.get('ingredients/' + item)
                .then((res_ing) => {
                    API.get('types/' + res_ing?.types_id)
                        .then((res_type) => {
                            let tempContent = {
                                id: res_ing?.id,
                                name: res_ing?.name,
                                type_id: res_type?.id,
                                type_name: res_type?.name
                            }
                            tempIng.push(tempContent);
                        }).finally(() => {
                            setIngredients(tempIng);
                        })
                });
        })
    }, []);
    
    return (
        <ProductDetailedContainer>
            <button onClick={handleState}>
                <CloseOutline
                    color={'#00000'} 
                    title={''}
                    height="30px"
                    width="30px"
                    style={{position:'absolute', left: '2rem', top: '2rem'}}
                />
            </button>
            <img src={URI + product?.image} alt={product?.name} style={{height:250, margin: 'auto', marginBottom:40}}/>
            <div style={{ backgroundColor: '#ffffff', width: '100%', minHeight: 420, borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: '3rem' }}>
                <p style={{fontSize:'2rem',marginBottom:20}}>{product?.name}</p>
                <p style={{marginBottom:20}}>Php {product?.price}</p>
                <button style={{width: '100%', height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10}} onClick={() => {
                    console.log('clicked customized');
                }}>
                    Customizations
                </button>
                <div>
                    {ingredients?.map((ingredients, idx) => {
                        console.log(ingredients, idx);
                        return (
                            <div key={idx} style={{height:80,display:'block',paddingBottom:10}}>
                                <p style={{display:'flex', justifyContent:'space-evenly', alignItems:'center', width:'100%', height:'100%'}}><span>{ingredients.type_name}</span> <span>{ingredients.name}</span></p>
                                <hr style={{ backgroundColor:'#26140D'}}/>
                            </div>
                        );
                    })}
                </div>
            </div>
        </ProductDetailedContainer>
    )
}

const ProductDetailedContainer = styled.div`
    background: #F1DEC9;
    width: 100%;
    height: 100%;
`;