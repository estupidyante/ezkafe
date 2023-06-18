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
    const [total, setTotal] = useState(0);
    const [ordered, setOrdered] = useState(0);
    const [isPlaced, setIsPlaced] = useState(false);
    let electricFee = 10;

    const handleBuyNow = () => {
        setTotal(parseInt(product.price) + electricFee);
        var user = {
            name: 'x'
        }
        console.log(product);
        console.log(product.ingredients);
        API.post('client/create', user)
            .then((response) => {
                var order = {
                    clients_id: response?.id,
                    products_id: product.id,
                    amount: parseInt(product.price) + electricFee,
                    status: 'in-progress'
                }
                console.log(order);
                API.post('order/create', order, product.ingredients)
                    .then((res_order) => {
                        setOrdered(res_order);
                        setIsPlaced(true);
                    })
            })
    }

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
            {isPlaced && <>
                <PaymentTotalHolder>
                    <strong style={{textAlign:'left',marginRight:1}}>Order ID:</strong>
                    <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                    <p>{ordered.id}</p>
                </PaymentTotalHolder>
                <PaymentTotalHolder style={{marginBottom:'5rem'}}>
                    <strong style={{textAlign:'left',marginRight:1}}>User ID:</strong>
                    <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                    <p>{ordered.clients_id}</p>
                </PaymentTotalHolder>
            </>}
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
                <p>Php {(parseInt(product.price) + electricFee).toFixed(2)}</p>
            </PaymentTotalHolder>
            {!isPlaced && <button style={{width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={handleBuyNow}>
                Buy Now
            </button>}
            {isPlaced && <button style={{width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={() => {
                window.print();
            }}>
                Print Order
            </button>}
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
