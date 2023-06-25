import { useEffect, useState } from 'react';
import styled from 'styled-components';
import { 
    ArrowBackCircleOutline,
    CheckmarkCircleOutline,
    CheckmarkCircleSharp,
    CheckmarkDoneCircleSharp,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';
import { OrderLists } from 'components/Lists/OrderLists';
import { NumericFormat } from 'react-number-format';

export const PaymentDetalPage = ({product, handlePayment}) => {
    const [total, setTotal] = useState(0);
    const [ordered, setOrdered] = useState(0);
    const [isPlaced, setIsPlaced] = useState(false);
    const [isConfirmed, setIsConfirmed] = useState(false);

    useEffect(() => {
        console.log('product.price: ', product.price);
        setTotal(product.price);
    }, []);

    const handleBuyNow = () => {
        setTotal(parseInt(product.price));
        // setIsPlaced(true);
        var user = {
            name: 'x'
        }
        API.post('client/create', user)
            .then((response) => {
                var order = {
                    clients_id: response?.id,
                    products_id: product.id,
                    amount: parseInt(product.price),
                    status: 'in-progress'
                }
                API.post('order/create', [order, product])
                    .then((res_order: any) => {
                        setOrdered(res_order.message);
                        setIsPlaced(true);
                        alert("Order Created Successfully");
                    })
            })
    }

    const handleConfirmed = () => {
        setIsConfirmed(true);
        setTimeout(() => {
            handlePayment();
        }, 3000);
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
            <p style={{fontFamily:'Cormorant Garamond',fontSize:'xx-large',fontWeight:'bolder',marginBottom:20}}>{product?.name}</p>
            <OrderLists ingredients={product?.ingredients}/>
            <PaymentTotalHolder>
                <strong style={{textAlign:'left',marginRight:1}}>Subtotal:</strong>
                <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                <div><NumericFormat value={parseInt(product?.price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></div>
            </PaymentTotalHolder>
            <PaymentTotalHolder>
                <strong style={{textAlign:'left',marginRight:1}}>Total:</strong>
                <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                <div><NumericFormat value={total} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></div>
            </PaymentTotalHolder>
            {!isPlaced && <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={handleBuyNow}>
                Buy Now
            </button>}
        </div>
        {
            (isPlaced && !isConfirmed) && <PaymentOrderDetailsOverlay>
                <PaymentOrderDetails>
                    <p style={{display:'flex',justifyContent:'center'}}>
                        <strong style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginRight:5}}>Order ID:</strong>
                        <span style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'left',}}>{ordered.id}</span>
                    </p>
                    <p style={{display:'flex',justifyContent:'center',marginBottom:'5rem'}}>
                        {/* <strong style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginRight:5}}>User ID:</strong> */}
                        {/* <span style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'left',}}>{ordered.clients_id}</span> */}
                    </p>
                    <p style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'center',marginRight:1}}>Payment Due</p>
                    <div style={{fontFamily:'Cormorant Garamond',fontSize:'xx-large',fontWeight:'bolder',textAlign:'center',marginRight:1}}>
                        <NumericFormat value={parseInt(ordered.price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} />
                    </div>
                    <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={() => {
                        handleConfirmed();
                    }}>
                        Confirm
                    </button>
                </PaymentOrderDetails>
            </PaymentOrderDetailsOverlay>
        }
        {
            isConfirmed && <PaymentOrderDetailsOverlay>
                <PaymentOrderDetails>
                    <p style={{display:'flex',justifyContent:'center'}}>
                        <strong style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginRight:5}}>Order ID:</strong>
                        <span style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'left',}}>{ordered.id}</span>
                    </p>
                    <p style={{display:'flex',justifyContent:'center',marginBottom:'5rem'}}>
                        {/* <strong style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginRight:5}}>User ID:</strong> */}
                        {/* <span style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'left',}}>{ordered.clients_id}</span> */}
                    </p>
                    <p style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'center',marginRight:1,display:'flex',alignItems:'center',justifyContent:'space-evenly',width:'65%',margin:'auto'}}>
                            <CheckmarkCircleSharp
                                color={'#6BA91D'} 
                                beat 
                                title={'check'}
                                height="30px"
                                width="30px"
                            />
                        <span>Payment Successful</span>
                    </p>
                    <div style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'center',marginRight:1,display:'flex',alignItems:'center',justifyContent:'space-evenly',width:'65%',margin:'auto'}}>
                        <div>
                            <CheckmarkCircleSharp
                                color={'#6BA91D'} 
                                beat 
                                title={'check'}
                                height="30px"
                                width="30px"
                            />
                        </div>
                        <div>
                            <p style={{textAlign:'left'}}>Order Status</p>
                            <p style={{textAlign:'left',fontSize:'small'}}>Despensing { ordered.status }...</p>
                        </div>
                    </div>
                    <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#97C361', color: '#000000', borderRadius: 10,marginTop:'5rem'}} onClick={() => {
                        handlePayment();
                    }}>
                        Order Complete
                    </button>
                </PaymentOrderDetails>
            </PaymentOrderDetailsOverlay>
        }
    </PaymentDetailedContainer>)
}

const PaymentOrderDetails = styled.section`
    background:#ffffff;
    width:320px;
    height:320px;
    margin:auto;
    border-radius: 10px;
    padding:20px;
    box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
    -webkit-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
    -moz-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
`;
const PaymentOrderDetailsOverlay = styled.section`
    background: rgba(0,0,0,0.70);
    position:absolute;
    scroll:none;
    top:0;
    bottom:0;
    left:0;
    right:0;
    margin-top:-50px;
    display:flex;
    height:800px;
`;

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
