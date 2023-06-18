import { useEffect, useState } from 'react';
import styled from 'styled-components';
import { 
    ArrowBackCircleOutline,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';
import { OrderLists } from 'components/Lists/OrderLists';

export const PaymentDetalPage = ({product, handlePayment}) => {
    let electricFee = 10;

    return (<PaymentDetailedContainer>
        <div style={{height:80, marginBottom:40,display:'flex',alignItems:'center',justifyContent:'space-evenly'}}>
            <button onClick={handlePayment}>
                <ArrowBackCircleOutline
                    color={'#00000'} 
                    title={''}
                    height="30px"
                    width="30px"
                    style={{position:'absolute', left: '2rem', top: '2rem'}}
                />
            </button>
            <h1 style={{width:'90%'}}>Order Details</h1>
        </div>
        <div style={{ backgroundColor: '#ffffff', width: '100%', minHeight: 620, borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: '3rem' }}>
            <p style={{fontSize:'2rem',marginBottom:20}}>{product?.name}</p>
            {/* <p style={{marginBottom:20}}>Php {parseFloat(product?.price).toFixed(2)}</p> */}
            <OrderLists ingredients={product?.ingredients}/>
            <PaymentTotalHolder>
                <strong style={{textAlign:'left',marginRight:1}}>Subtotal:</strong>
                <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                <p>Php {(parseFloat(product.price)).toFixed(2)}</p>
            </PaymentTotalHolder>
            <PaymentTotalHolder>
                <strong style={{textAlign:'left',marginRight:1}}>Electric Fee:</strong>
                <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                <p>Php {electricFee.toFixed(2)}</p>
            </PaymentTotalHolder>
            <PaymentTotalHolder>
                <strong style={{textAlign:'left',marginRight:1}}>Total:</strong>
                <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                <p>Php {(parseFloat(product.price) + electricFee).toFixed(2)}</p>
            </PaymentTotalHolder>
            <button style={{height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,position:'absolute',bottom:0,left:'2rem',right:'2rem' }} onClick={handlePayment}>
                Buy Now
            </button>
        </div>
    </PaymentDetailedContainer>)
}

const PaymentTotalHolder = styled.section`
    display: flex;                     /* 1 */
    align-items: baseline;             /* 2 */
    margin-top:2rem;
    margin-bottom:2rem;
    > * {
        padding: 0;
        margin: 0;
    }
`;
const PaymentTotalSpanSpace = styled.section`
    flex: 1;                          /* 3 */
    overflow: hidden;                 /* 4 */
`;

const PaymentDetailedContainer = styled.div`
    position: absolute;
    background: #F1DEC9;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin-top:40px;
`;
