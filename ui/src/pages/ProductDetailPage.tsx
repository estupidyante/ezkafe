import { useEffect, useState } from 'react';
import styled from 'styled-components';
import { NumericFormat } from 'react-number-format';
import { 
    CloseOutline,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';
import { ProductIngredientLists } from 'components/Lists/ProductIngredientLists';

export const ProductDetailPage = ({product, handleState, handleCustomize, handlePayment}) => {
    const [ingredients, setIngredients] = useState(Array);

    useEffect(() => {
        setIngredients(product.ingredients);
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
                <p style={{fontFamily:'Cormorant Garamond',fontSize:'xx-large',fontWeight:'bolder'}}>{product?.name}</p>
                <p style={{marginBottom:20,fontSize:'xx-large',fontWeight:'bolder'}}><NumericFormat value={parseInt(product?.price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></p>
                <button style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',width: '100%', height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10}} onClick={handleCustomize}>
                    Customize
                </button>
                <ProductIngredientLists ingredients={ingredients}/>
                <button style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',width: '100%', height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10, marginTop:'2rem'}} onClick={handlePayment}>
                    Proceed Payment
                </button>
            </div>
        </ProductDetailedContainer>
    )
}

const ProductDetailedContainer = styled.div`
    background: #F1DEC9;
    width: 100%;
    height: 100%;
`;