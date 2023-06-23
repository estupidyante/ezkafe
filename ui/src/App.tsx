import { useEffect, useState, } from 'react';
import {
  Wrapper,
  ContentContainer,
  SimpleButton,
  SearchContainer,
  SearchBoxContainer,
  SearchIconContainer,
  CardHeroContainer,
  CardHero,
  Container,
  Section,
  CardHeroTitle,
  CardHeroText,
  CardHeroButton,
  TextSpan,
  CardProductContainer,
  CardProductLists,
  CardProductItem,
  CardProduct,
  CardProductImage,
  CardProductContent,
  CardProductTitle,
  CardProductDescription,
  CardProductPrice,
  OrderButton,
  Footer,
  FooterTop, 
  FooterBrand,
  DividerLineTop,
  FooterBottom,
} from './lib/Contants';
import { 
  SearchOutline,
  ArrowForwardOutline,
  LogoFacebook,
  LogoTwitter,
  LogoInstagram,
} from 'react-ionicons';
import {
  URI,
  API,
} from './api';

import { HeaderComponent } from 'components/Header';
import { ProductSmallCard } from 'components/Lists/ProductSmallCard';
import { PaymentDetalPage } from 'pages/PaymentDetailPage';
import { ProductDetailPage } from './pages/ProductDetailPage';
import { CustomProductDetailPage } from './pages/CustomProductDetailPage';
import { NumericFormat } from 'react-number-format';
// import { SearchBar } from 'components/SearchBar/SearchBar';
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.css";
import "./lib/tabStyles.css";

function App() {
  const [isOrdered, setIsOrdered] = useState(false);
  const [tabIndex, setTabIndex] = useState(0);
  const [isDetailed, setIsDetailed] = useState(false);
  const [isPayment, setIsPayment] = useState(false);
  const [isCustomized, setIsCustomized] = useState(false);
  const [selectedProduct, setSelectedProduct] = useState([]);

  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);

  const [isTopProduct, setIsTopProduct] = useState(false);
  const [topProduct, setTopProduct] = useState([]);

  let productTabPanel = {};

  useEffect(() => {
    API.get('categories')
      .then((res: any) => {
        setCategories(res);
      })
      .finally(() => {
        API.get(`products`)
        .then((res_prod: any) => {
          setProducts(res_prod);
        })
      })
    API.get('/products/ordered')
      .then((res_ordered) => {
        if(res_ordered && (res_ordered[0] && res_ordered[0]['products_id'])) {
          API.get('/product/' + res_ordered[0]['products_id'])
            .then((res_product_ordered: any) => {
              // console.log('product: ', res_product_ordered[0]);
              setTopProduct(res_product_ordered[0]);
              setIsTopProduct(true);
            })
        }
      })
  }, []);

  const handleDetailedState = () => {
    if(isDetailed) setIsDetailed(false)
    else setIsDetailed(true);
  }
  const handleCustomize = () => {
    if(isCustomized) setIsCustomized(false)
    else setIsCustomized(true);
  }
  const handleToDetails = () => {
    setIsCustomized(false);
    setIsDetailed(true);
    setIsPayment(false);
  }
  const handlePayment = () => {
    if(isPayment) setIsPayment(false)
    else setIsPayment(true);
  }
  const handleSelectedProduct = (item) => {
    setSelectedProduct(item);
  }

  const handleClickOrder = () => {
    if(isOrdered) setIsOrdered(false)
    else setIsOrdered(true);
  };

  return (
    <Wrapper>
      {(!isDetailed && !isPayment && !isCustomized) && <div>
        <HeaderComponent/>
        <ContentContainer>
          {/* <SearchContainer>
            <SearchBar data={products} handleState={handleDetailedState} handleSelected={handleSelectedProduct} />
            <SearchIconContainer>
              <SearchOutline
                color={'#00000'} 
                title={''}
                height="30px"
                width="30px"
              />
            </SearchIconContainer>
          </SearchContainer> */}
          {(topProduct && isTopProduct) && <CardHero>
            <CardHeroContainer>
              <CardHeroTitle>
                Best Seller<br/>
                <strong>of the week</strong>
              </CardHeroTitle>
              <CardHeroText>{topProduct.name}</CardHeroText>
              <CardHeroButton>
                <TextSpan onClick={() => {
                    setIsDetailed(true);
                    setSelectedProduct(topProduct);
                  }}>More Info</TextSpan>
                <ArrowForwardOutline
                  color={'#ffffff'}
                  title={''}
                  height="18px"
                  width="18px"
                />
              </CardHeroButton>
            </CardHeroContainer>
            <img src={URI + topProduct?.image} alt={topProduct?.name} style={{width:200}}/>
          </CardHero>}
          <Section style={{marginTop:'1rem'}}>
            <h2>EzKafe Drink Menu</h2>
            {!isOrdered && <Button onClick={handleClickOrder}>
              <span>See all</span>
              <ArrowForwardOutline
                  color={'#26140D'}
                  title={''}
                  height="18px"
                  width="18px"
                />
            </Button>}
          </Section>
          {!isOrdered && <CardProductContainer>
            <Container>
              <CardProductLists>
              {products.map((item, i) => {
                if(i >= 2) return ('');
                return (
                  <CardProductItem key={i} onClick={() => {
                    setIsDetailed(true);
                    setSelectedProduct(item);
                  }}>
                  <CardProduct>
                    <CardProductImage src={URI + item?.image} alt={item?.name} />
                    <CardProductContent>
                      <CardProductTitle>{item?.name}</CardProductTitle>
                      <CardProductDescription>{item?.description}</CardProductDescription>
                      <CardProductPrice value="180.85"><NumericFormat value={parseInt(item?.price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></CardProductPrice>
                    </CardProductContent>
                  </CardProduct>
                </CardProductItem>
                );
              })}
      
              </CardProductLists>
            </Container>
          </CardProductContainer>}
          {!isOrdered && <Section>
            <Button kind={''} onClick={handleClickOrder}>Order Now</Button>
          </Section>}
          {isOrdered && <Section style={{paddingBottom:'0px'}}>
            <DividerLineTop></DividerLineTop>
            <br/>
            <br/>
            <Tabs defaultIndex={tabIndex} style={{width:'100%'}}>
              <TabList>
              {categories.map((item, i) => {
                productTabPanel[i] = products.filter(product => {
                  return product.category_id === item.id;
                });
                return(
                    <Tab key={i}>
                      {item?.name} based
                    </Tab>
                );
              })}
              </TabList>
              {categories.map((_item, idx) => {
                return(<TabPanel key={idx} style={{ backgroundColor: '#ffffff', width: '110%', marginLeft:'-5%', height: 'auto', borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: 20 }}>
                  <ProductSmallCard products={productTabPanel[idx]}  handleState={handleDetailedState} handleSelected={handleSelectedProduct}/>
                </TabPanel>);
              })}
            </Tabs>
          </Section>}
        </ContentContainer>
        <Footer>
          <FooterTop>
            <FooterBrand>
              <LogoFacebook
                color={'#ffffff'} 
                title={'facebook'}
                height="50px"
                width="50px"
              />
              <LogoTwitter
                color={'#ffffff'} 
                title={'twitter'}
                height="50px"
                width="50px"
              />
              <LogoInstagram
                color={'#ffffff'} 
                title={'instagram'}
                height="50px"
                width="50px"
              />
            </FooterBrand>
          </FooterTop>
          <FooterBottom>
            <p style={{ display:'flex',alignItems:'center',justifyContent:'center',marginBottom:'1rem'}}>Have a Questions? Click <button style={{color:'#ffffff',marginLeft:'0.5rem'}} onClick={() => {}}> here.</button></p>
            <p>Al Rights Reserve. 2023</p>
          </FooterBottom>
        </Footer>
      </div>}
      {(isDetailed && !isPayment && !isCustomized) && <ProductDetailPage product={selectedProduct} handleState={handleDetailedState} handleCustomize={handleCustomize} handlePayment={handlePayment}/>}
      {(isCustomized && !isPayment) && <CustomProductDetailPage product={selectedProduct} categories={categories} handlePayment={handlePayment} handleState={handleToDetails}/>}
      {(isPayment) && <div style={{ backgroundColor: '#ffffff', width: '100%', height: 'auto', borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: 20 }}>
        <PaymentDetalPage product={selectedProduct} handlePayment={handlePayment}/>
      </div>}
    </Wrapper>
  );
}

const Button = ({ kind = 'simple', onClick, children }) => {
  if (kind == 'simple') {
    return (
      <SimpleButton type="button" onClick={onClick}>
        {children}
      </SimpleButton>
    );
  } else {
    return (
      <OrderButton type="button" onClick={onClick}>
        {children}
      </OrderButton>
    );
  }
};

export default App;

