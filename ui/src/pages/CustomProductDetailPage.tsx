import { useEffect, useState } from 'react';
import styled, { keyframes } from 'styled-components';
import { 
    ArrowBackCircleOutline,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';
import { CustomOrderLists } from 'components/Lists/CustomOrderLists';
import { NumericFormat } from 'react-number-format';

export const CustomProductDetailPage = ({product, categories, handlePayment, handleState}) => {
    const [ingredients, setIngredients] = useState(Array);
    const [total, setTotal] = useState(0);
    const [ordered, setOrdered] = useState(0);
    const [isPlaced, setIsPlaced] = useState(false);
    let electricFee = 10;

    useEffect(() => {
        console.log(product);
        setIngredients(product.ingredients);
    }, []);

    const handlePriceChange = (price) => {
        //
    }

    const handleBuyNow = () => {
        setTotal(parseInt(product.price) + electricFee);
        // var user = {
        //     name: 'x'
        // }
        // API.post('client/create', user)
        //     .then((response) => {
        //         var order = {
        //             clients_id: response?.id,
        //             products_id: product.id,
        //             amount: parseInt(product.price) + electricFee,
        //             status: 'in-progress'
        //         }
        //         API.post('order/create', order)
        //             .then((res_order) => {
        //                 setOrdered(res_order);
        //                 setIsPlaced(true);
        //             })
        //     })
    }

    return (
        <CustomizedProductDetailedContainer>
            <div style={{height:80, marginBottom:40,display:'flex',alignItems:'center',justifyContent:'space-evenly'}}>
                <button onClick={handleState}>
                    <ArrowBackCircleOutline
                        color={'#00000'} 
                        title={''}
                        height="30px"
                        width="30px"
                        style={{position:'absolute', left: '2rem', top: '2rem'}}
                    />
                </button>
                <h1 style={{fontSize:'xx-large',fontWeight:'bolder',width:'90%'}}>Create Order</h1>
            </div>
            <div style={{ backgroundColor: '#ffffff', width: '100%', minHeight: 620, borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: '3rem' }}>
                <div style={{padding:'2rem',backgroundColor:'#D9D9D9',marginBottom:20,borderRadius:10,minHeight:80,height:'auto'}}>
                    <p style={{fontFamily:'Cormorant Garamond',fontSize:'xx-large',fontWeight:'bolder',textAlign:'left'}}>{product?.name}</p>
                    {
                        categories.map((category, idx) => {
                            if(category.id === product?.category_id) {
                                return (<p style={{fontFamily:'Playfair Display',fontStyle:'italic',textAlign:'left'}}>{category.name} base drink</p>)
                            }
                        })
                    }
                </div>
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
                <CustomOrderLists ingredients={product?.ingredients} handlePriceChange={handlePriceChange}/>
                <PaymentTotalHolder>
                    <strong style={{textAlign:'left',marginRight:1}}>Subtotal:</strong>
                    <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                    <p><NumericFormat value={parseInt(product?.price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></p>
                </PaymentTotalHolder>
                <PaymentTotalHolder>
                    <strong style={{textAlign:'left',marginRight:1}}>Electric Fee:</strong>
                    <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                    <p><NumericFormat value={electricFee} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></p>
                </PaymentTotalHolder>
                <PaymentTotalHolder>
                    <strong style={{textAlign:'left',marginRight:1}}>Total:</strong>
                    <PaymentTotalSpanSpace>..............................................................................................................................................................</PaymentTotalSpanSpace>
                    <p><NumericFormat value={parseInt(product?.price) + electricFee} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></p>
                </PaymentTotalHolder>
                {!isPlaced && <button style={{fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={handleBuyNow}>
                    Buy Now
                </button>}
                {isPlaced && <button style={{fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={() => {
                    window.print();
                }}>
                    Print Order
                </button>}
            </div>
        </CustomizedProductDetailedContainer>
    )
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

const CustomizedProductDetailedContainer = styled.div`
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