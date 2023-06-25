import { useCallback, useEffect, useState } from 'react';
import styled, { keyframes } from 'styled-components';
import { 
    CloseOutline,
    ArrowBackCircleOutline,
    CheckmarkCircleOutline,
    CheckmarkCircleSharp,
    CheckmarkDoneCircleSharp,
} from 'react-ionicons';
import {
    URI,
    API,
} from '../api';
import { CustomOrderLists } from 'components/Lists/CustomOrderLists';
import { NumericFormat } from 'react-number-format';
import LoadingOverlay from 'react-loading-overlay-ts';

export const CustomProductDetailPage = ({product, totalPrice, categories, handlePayment, handleState}) => {
    const [, updateState] = useState();
    const forceUpdate = useCallback(() => updateState({}), []);
    const [isLoading, setIsLoading] = useState(true);
    const [ingredients, setIngredients] = useState(Array);
    const [total, setTotal] = useState(0);
    const [ordered, setOrdered] = useState([]);
    const [isProceed, setIsProceed] = useState(false);
    const [isPlaced, setIsPlaced] = useState(false);
    const [isConfirmed, setIsConfirmed] = useState(false);

    const [selectedCustomProduct, setSelectedCustomProduct] = useState(Array);
    const [preferredMeasurements, setPreferredMeasurement] = useState([]);

    let tempPreferredMeasurements = [];

    useEffect(() => {
        console.log('preferred measurements: ', product.measurement_ids.split(","));
        tempPreferredMeasurements = product.ingredients.map((ing, idx) => {
            return {
                ing_id: ing.id,
                measurement: ing.measurement,
                measurement_id: ing.measurements_id,
            }
        })
        console.log('tempPreferredMeasurements', tempPreferredMeasurements);
        setPreferredMeasurement(tempPreferredMeasurements);
        setIsLoading(true);
        API.get('ingredients')
            .then((response_ing) => {
                setIngredients(response_ing);
            }).finally(() => {
                API.get('product/' + product.id)
                    .then((response_product) => {
                        setSelectedCustomProduct(response_product.message[0]);
                    }).finally(() => {
                        setIsLoading(false);
                        console.log('totalPrice', totalPrice);
                    })
            })
    }, []);

    useEffect(() => {
        setTotal(totalPrice);
    }, [totalPrice]);

    const nameData = {
        "firstName": [
            "nar",
            "An",
            "Alfr",
            "Alvi",
            "Ari",
            "Arinbjorn",
            "Arngeir",
            "Arngrim",
            "Arnfinn",
            "Asgeirr",
            "Askell",
            "Asvald",
            "Bard",
            "Baror",
            "Bersi",
            "Borkr",
            "Bjarni",
            "Bjorn",
            "Brand",
            "Brandr",
            "Cairn",
            "Canute",
            "Dar",
            "Einarr",
            "Eirik",
            "Egill",
            "Engli",
            "Eyvindr",
            "Erik",
            "Eyvind",
            "Finnr",
            "Floki",
            "Fromund",
            "Geirmundr",
            "Geirr",
            "Geri",
            "Gisli",
            "Gizzur",
            "Gjafvaldr",
            "Glumr",
            "Gorm",
            "Grmir",
            "Gunnarr",
            "Guomundr",
            "Hak",
            "Halbjorn",
            "Halfdan",
            "Hallvard",
            "Hamal",
            "Hamundr",
            "Harald",
            "Harek",
            "Hedinn",
            "Helgi",
            "Henrik",
            "Herbjorn",
            "Herjolfr",
            "Hildir",
            "Hogni",
            "Hrani",
            "Ivarr",
            "Hrolf",
            "Jimmy",
            "Jon",
            "Jorund",
            "Kalf",
            "Ketil",
            "Kheldar",
            "Klaengr",
            "Knut",
            "Kolbeinn",
            "Kolli",
            "Kollr",
            "Lambi",
            "Magnus",
            "Moldof",
            "Mursi",
            "Njall",
            "Oddr",
            "Olaf",
            "Orlyg",
            "Ormr",
            "Ornolf",
            "Osvald",
            "Ozurr",
            "Poror",
            "Prondir",
            "Ragi",
            "Ragnvald",
            "Refr",
            "Runolf",
            "Saemund",
            "Siegfried",
            "Sigmundr",
            "Sigurd",
            "Sigvat",
            "Skeggi",
            "Skomlr",
            "Slode",
            "Snorri",
            "Sokkolf",
            "Solvi",
            "Surt",
            "Sven",
            "Thangbrand",
            "Thjodoft",
            "Thorod",
            "Thorgest",
            "Thorvald",
            "Thrain",
            "Throst",
            "Torfi",
            "Torix",
            "Tryfing",
            "Ulf",
            "Valgaror",
            "Vali",
            "Vifil",
            "Vigfus",
            "Vika",
            "Waltheof"
        ],
        "lastNamePrefix": [
            "Aesir",
            "Axe",
            "Battle",
            "Bear",
            "Berg",
            "Biscuit",
            "Black",
            "Blade",
            "Blood",
            "Blue",
            "Boar",
            "Board",
            "Bone",
            "Cage",
            "Cave",
            "Chain",
            "Cloud",
            "Coffee",
            "Code",
            "Death",
            "Dragon",
            "Dwarf",
            "Eel",
            "Egg",
            "Elk",
            "Fire",
            "Fjord",
            "Flame",
            "Flour",
            "Forge",
            "Fork",
            "Fox",
            "Frost",
            "Furnace",
            "Cheese",
            "Giant",
            "Glacier",
            "Goat",
            "God",
            "Gold",
            "Granite",
            "Griffon",
            "Grim",
            "Haggis",
            "Hall",
            "Hamarr",
            "Helm",
            "Horn",
            "Horse",
            "House",
            "Huskarl",
            "Ice",
            "Iceberg",
            "Icicle",
            "Iron",
            "Jarl",
            "Kelp",
            "Kettle",
            "Kraken",
            "Lake",
            "Light",
            "Long",
            "Mace",
            "Mead",
            "Maelstrom",
            "Mail",
            "Mammoth",
            "Man",
            "Many",
            "Mountain",
            "Mutton",
            "Noun",
            "Oath",
            "One",
            "Owl",
            "Pain",
            "Peak",
            "Pine",
            "Pot",
            "Rabbit",
            "Rat",
            "Raven",
            "Red",
            "Refreshingbeverage",
            "Ring",
            "Rime",
            "Rock",
            "Root",
            "Rune",
            "Salmon",
            "Sap",
            "Sea",
            "Seven",
            "Shield",
            "Ship",
            "Silver",
            "Sky",
            "Slush",
            "Smoke",
            "Snow",
            "Spear",
            "Squid",
            "Steam",
            "Stone",
            "Storm",
            "Swine",
            "Sword",
            "Three",
            "Tongue",
            "Torch",
            "Troll",
            "Two",
            "Ulfsark",
            "Umlaut",
            "Unsightly",
            "Valkyrie",
            "Wave",
            "White",
            "Wolf",
            "Woman",
            "Worm",
            "Wyvern"
        ],
        "lastNameSuffix": [
            "admirer",
            "arm",
            "axe",
            "back",
            "bane",
            "baker",
            "basher",
            "beard",
            "bearer",
            "bender",
            "blade",
            "bleeder",
            "blender",
            "blood",
            "boiler",
            "bone",
            "boot",
            "borer",
            "born",
            "bow",
            "breaker",
            "breeder",
            "bringer",
            "brow",
            "builder",
            "chaser",
            "chiller",
            "collar",
            "counter",
            "curser",
            "dancer",
            "deck",
            "dottir",
            "doubter",
            "dreamer",
            "drinker",
            "drowner",
            "ear",
            "eater",
            "face",
            "fearer",
            "friend",
            "foot",
            "fury",
            "gorer",
            "grim",
            "grinder",
            "grower",
            "growth",
            "hacker",
            "hall",
            "hammer",
            "hand",
            "hands",
            "head",
            "hilt",
            "hugger",
            "hunter",
            "killer",
            "leg",
            "licker",
            "liker",
            "lost",
            "lover",
            "maker",
            "mender",
            "minder",
            "miner",
            "mocker",
            "monger",
            "neck",
            "puncher",
            "rage",
            "rhyme",
            "rider",
            "ringer",
            "roarer",
            "roller",
            "sailor",
            "screamer",
            "sequel",
            "server",
            "shield",
            "shoe",
            "singer",
            "skinner",
            "slinger",
            "slugger",
            "sniffer",
            "son",
            "smasher",
            "speaker",
            "stinker",
            "sucker",
            "sword",
            "tail",
            "tamer",
            "taster",
            "thigh",
            "tongue",
            "tosser",
            "tracker",
            "washer",
            "wielder",
            "wing",
            "wisher",
            "wrath"
        ]
    }

    function getRandom(items) {
        return items[Math.floor(Math.random()*items.length)];
    }

    const handlePriceChange = (id: number, mid: number, price: string) => {
        console.log('=== start handlePriceChange ===');
        console.log('preferredMeasurements', preferredMeasurements);
        console.log('ing_id', id);
        console.log('mid', mid);
        console.log('price', price);
        console.log('total', totalPrice);
        console.log('product.price', product.price);
        console.log('product', product);
        // preferredMeasurements.map((pmIng) => {
        //     console.log('ing_id', id);
        //     console.log('mid', mid);
        // })
        product.ingredients.map((pIng) => {
            console.log('pIng', pIng);
            if (pIng.id == id && pIng.measurements_id == mid) {
                totalPrice = parseInt(totalPrice) + parseInt(pIng.price);
                setTotal(totalPrice);
                console.log('total', total);
                console.log('totalPrice', totalPrice);
            } else {
                totalPrice = parseInt(totalPrice) - parseInt(pIng.price);
                setTotal(totalPrice);
                console.log('total', total);
                console.log('totalPrice', totalPrice);
            }
        });
        console.log('=== end handlePriceChange ===');
        forceUpdate();
    }

    const handleProceed = () => {
        setIsProceed(true);
    }

    const handleBuyNow = () => {
        setIsLoading(true);
        console.log('totalPrice', total);
        console.log('selectedCustomProduct:', selectedCustomProduct);
        selectedCustomProduct.price = totalPrice;
        console.log('selectedCustomProduct:', selectedCustomProduct);
        // setIsPlaced(true);

        let tempFirstName:string = getRandom(nameData['firstName']);
        let tempLastNamePrefix:string = getRandom(nameData['lastNamePrefix']);
        let tempLastNameSuffix:string = getRandom(nameData['lastNameSuffix']);
        console.log(tempFirstName, tempLastNamePrefix, tempLastNameSuffix);
        var user = {
            name: tempFirstName + ' ' + tempLastNamePrefix + ' ' + tempLastNameSuffix
        }
        API.post('client/create', user)
            .then((response) => {
                var order = {
                    clients_id: response?.id,
                    products_id: selectedCustomProduct.id,
                    amount: total,
                    status: 'in-progress'
                }
                API.post('order/create', [order, selectedCustomProduct])
                    .then((res_order: any) => {
                        setOrdered(res_order.message);
                        setIsPlaced(true);
                        alert("Order Created Successfully");
                    }).finally(() => {
                        setIsLoading(false);
                    })
            })
    }

    const handleConfirmed = () => {
        setIsConfirmed(true);
        setTimeout(() => {
            handleState();
        }, 3000);
    }

    const handleCustomProduct = (customProduct: any) => {
        console.log('handleCustomProduct: ', customProduct);
        setSelectedCustomProduct(customProduct);
        forceUpdate();
    }

    return (
        <LoadingOverlay
            active={isLoading}
            spinner
            text='Loading... Brewing Coffee...'
            >
            <CustomizedProductDetailedContainer>
                <div style={{height:80, marginBottom:40,display:'flex',alignItems:'center',justifyContent:'space-evenly'}}>
                    <button onClick={handleState}>
                        <CloseOutline
                            color={'#00000'} 
                            title={''}
                            height="30px"
                            width="30px"
                            style={{position:'absolute', left: '2rem', top: '2rem'}}
                        />
                    </button>
                    {!isProceed && <h1 style={{fontSize:'xx-large',fontWeight:'bolder',width:'90%'}}>Create Order</h1>}
                    {isProceed && <h1 style={{fontSize:'xx-large',fontWeight:'bolder',width:'90%'}}>Order Details</h1>}
                </div>
                <div style={{ backgroundColor: '#ffffff', width: '100%', minHeight: 620, borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: '3rem' }}>
                    <div style={{padding:'2rem',backgroundColor:'#D9D9D9',marginBottom:20,borderRadius:10,minHeight:80,height:'auto'}}>
                        <p style={{fontFamily:'Cormorant Garamond',fontSize:'xx-large',fontWeight:'bolder',textAlign:'left'}}>{product?.name}</p>
                        {
                            categories.map((category, idx) => {
                                if(category.id === product?.category_id) {
                                    return (<p key={idx} style={{fontFamily:'Playfair Display',fontStyle:'italic',textAlign:'left'}}>{category.name} base drink</p>)
                                }
                            })
                        }
                    </div>
                    <CustomOrderLists product={product} handlePriceChange={handlePriceChange} handleCustomProduct={handleCustomProduct} isFinal={isProceed}/>
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
                    {!isProceed && <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={handleProceed}>
                        Place Order
                    </button>}
                    {isProceed && <button style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',width:'100%',height:50, backgroundColor: '#26140D', color: '#ffffff', borderRadius: 10,marginTop:'5rem'}} onClick={handleBuyNow}>
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
                                {/* <strong style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginRight:5}}>User ID:</strong>
                                <span style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'left',}}>{ordered.clients_id}</span> */}
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
                                {/* <strong style={{fontFamily:'Cormorant Garamond',fontSize:'x-large',fontWeight:'bolder',textAlign:'left',marginRight:5}}>User ID:</strong>
                                <span style={{fontFamily:'Cormorant Garamond',fontSize:'large',fontWeight:'bolder',textAlign:'left',}}>{ordered.clients_id}</span> */}
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
            </CustomizedProductDetailedContainer>
        </LoadingOverlay>
    )
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
    position:fixed;
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

const CustomizedProductDetailedContainer = styled.div`
    background: #F1DEC9;
    width: 100%;
    height: 100%;
    padding-top:40px;
`;
