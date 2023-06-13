import styled, { keyframes } from 'styled-components';
import { 
    CloseOutline,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';

export const ProductDetailPage = (products: [], status: 'true') => {
    const product = products?.data;
    return (
        <ProductDetailedContainer>
            <button onClick={() => {
                  console.log('close clicked');
                }}>
                <CloseOutline
                    color={'#00000'} 
                    title={''}
                    height="30px"
                    width="30px"
                    style={{position:'absolute', left: '2rem', top: '2rem'}}
                />
            </button>
            <img src={URI + product?.image} alt={product?.name} style={{width:'60%', margin: 'auto'}}/>
            <div style={{ backgroundColor: '#ffffff', width: '100%', height: '100%', display: 'flex', borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', justifyContent: 'space-evenly', padding: '3rem' }}>
                <p style={{fontSize:'2rem'}}>{product?.name}</p>
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