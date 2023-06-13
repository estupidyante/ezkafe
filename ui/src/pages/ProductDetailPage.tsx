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
    let tempIng = [{}];

    useEffect(() => {
        product?.ing_ids.split(',').map((item, i) => {
            API.get('ingredients/' + item)
                .then((res_ing) => {
                    API.get('types/' + res_ing?.types_id)
                        .then((res_type) => {
                            tempIng[i] = {
                                id: res_ing?.id,
                                name: res_ing?.name,
                                type_id: res_type.id,
                                type_name: res_type.name
                            }
                        }).finally(() => {
                            setIngredients(tempIng);
                            console.log(ingredients);
                        })
                });
        })
    }, [product]);
    
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
            <img src={URI + product?.image} alt={product?.name} style={{width:'60%', margin: 'auto'}}/>
            <div style={{ backgroundColor: '#ffffff', width: '100%', height: '100%', borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', justifyContent: 'space-evenly', padding: '3rem' }}>
                <p style={{fontSize:'2rem'}}>{product?.name}</p>
                <p>Php {product?.price}</p>
                <button style={{width: '100%', height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 20}} onClick={() => {
                    console.log('clicked customized');
                }}>
                    Customizations
                </button>
                <div>
                    {ingredients?.map((ingredients, idx) => {
                        return (
                            <div key={idx} style={{borderBottomStyle:'solid',borderBottom:1,borderColor:'#26140D',height:80,display:'flex',alignItems:'center',justifyContent:'space-evenly'}}>
                                <p style={{display:'flex', justifyContent:'space-evenly',width:'100%'}}><span>{ingredients.type_name}</span> <span>{ingredients.name}</span></p>
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
    max-height: 1280px;
    z-index: 100;
    position: absolute;
    top: 0;
    height: 1280px;
`;