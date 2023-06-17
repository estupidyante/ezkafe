import { useEffect, useState } from 'react';
import styled, { keyframes } from 'styled-components';
import { 
    CloseOutline,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';
import { ProductIngredientLists } from 'components/Lists/ProductIngredientLists';

export const ProductDetailPage = ({product, handleState}) => {
    const [ingredients, setIngredients] = useState(Array);
    let tempIng = [];

    useEffect(() => {
        console.log(product);
        product?.ing_ids.split(',').map((item, i) => {
            console.log(item);
            API.get('product_ingredients/' + item)
                .then((response) => {
                    console.log(response);
                })
            // API.get('ingredients/' + item)
            //     .then((response) => {
            //         console.log(response);
            //         setIngredients(response);
            //         API.get('types/' + response?.types_id)
            //             .then((response_type) => {
            //                 console.log(response_type);
            //                 let tempContent = {
            //                     id: response?.id,
            //                     name: response?.name,
            //                     type_id: response_type?.id,
            //                     type_name: response_type?.name
            //                 }
            //                 tempIng.push(tempContent);
            //             })
            //         // API.get('types/' + res_ing?.types_id)
            //         //     .then((res_type) => {
            //         //         let tempContent = {
            //         //             id: res_ing?.id,
            //         //             name: res_ing?.name,
            //         //             type_id: res_type?.id,
            //         //             type_name: res_type?.name
            //         //         }
            //         //         tempIng.push(tempContent);
            //         //     }).finally(() => {
            //         //         setIngredients(tempIng);
            //         //     });
            //     }).catch((error) =>{
            //         console.log(error);
            //     });
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
                <ProductIngredientLists ingredients={ingredients}/>
            </div>
        </ProductDetailedContainer>
    )
}

const ProductDetailedContainer = styled.div`
    background: #F1DEC9;
    width: 100%;
    height: 100%;
`;