import { useEffect, useState, } from 'react';
import ReactSearchBox from 'react-search-box';
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
} from './lib/Contants';
import { 
  SearchOutline,
  ArrowForwardOutline,
} from 'react-ionicons';
import {
  URI,
  API,
} from './api';
import { ProductDetailPage } from './pages/ProductDetailPage';
import { HeaderComponent } from 'components/Header';
import { ProductSmallCard } from 'components/Lists/ProductSmallCard';

function App() {
  const [isOrdered, setIsOrdered] = useState(false);
  const [activeSwitch, setActiveSwitch] = useState('');
  const [isDetailed, setIsDetailed] = useState(false);
  const [selectedProduct, setSelectedProduct] = useState([]);

  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);

  useEffect(() => {
    API.get('categories')
      .then((res) => {
        setCategories(res);
      })
      .finally(() => {
        API.get(`products/`)
        .then(res => {
          setProducts(res);
        })
      })
  }, []);
  
  let data = [{}];

  useEffect(() => {
    data = products.map(item => ({key: item?.name, value: item?.name}));
  }, [products]);

  const handleDetailedState = () => {
    setIsDetailed(!isDetailed);
  }

  const handleSelectedProduct = (item) => {
    setSelectedProduct(item);
  }

  const handleClickOrder = () => {
    setIsOrdered(!isOrdered);
  };

  return (
    <Wrapper>
      {!isDetailed && <div>
        <HeaderComponent/>
        <ContentContainer>
          <SearchContainer>
            <SearchBoxContainer>
              <ReactSearchBox
                placeholder="Search"
                data={data} onSelect={function (record: { item: { key: string; value: string; }; }): void {
                  throw new Error('Function not implemented.');
                } } onChange={function (value: string): void {
                  throw new Error('Function not implemented.');
                } }      />
            </SearchBoxContainer>
            <SearchIconContainer>
              <SearchOutline
                color={'#00000'} 
                title={''}
                height="30px"
                width="30px"
              />
            </SearchIconContainer>
          </SearchContainer>
          <CardHero>
            <CardHeroContainer>
              <CardHeroTitle>
                Best Seller<br/>
                <strong>of the week</strong>
              </CardHeroTitle>
              <CardHeroText>Hot Butterscotch Latte</CardHeroText>
              <CardHeroButton>
                <TextSpan>More Info</TextSpan>
                <ArrowForwardOutline
                  color={'#ffffff'}
                  title={''}
                  height="18px"
                  width="18px"
                />
              </CardHeroButton>
            </CardHeroContainer>
          </CardHero>
          <Section>
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
                      <CardProductPrice value="180.85">Php {item?.price}</CardProductPrice>
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
          {isOrdered && <Section>
            <DividerLineTop></DividerLineTop>
            <br/>
            <br/>
            <div style={{ backgroundColor: '#ffffff', width: '100%', display: 'flex', borderRadius: 20, borderWidth: 1, borderStyle: 'solid' }}>
              {categories.map((item, i) => {
                return(
                  <button key={i} style={{ flex: '1 1 0px', height: '50px', borderRadius: 20, }} onClick={() => {
                    setActiveSwitch(item?.name);
                  }}>
                    {item?.name}
                  </button>
                );
              })}
            </div>
          </Section>}
        </ContentContainer>
        {isOrdered && <div style={{ backgroundColor: '#ffffff', width: '100%', height: 'auto', borderStartStartRadius: 20, borderStartEndRadius: 20, borderWidth: 1, borderStyle: 'solid', padding: 20 }}>
          <ProductSmallCard products={products}  handleState={handleDetailedState} handleSelected={handleSelectedProduct}/>
        </div>}

        <Footer>
          <FooterTop>
            <FooterBrand>

            </FooterBrand>
          </FooterTop>
        </Footer>
      </div>}
      {isDetailed && <ProductDetailPage product={selectedProduct} handleState={handleDetailedState}/>}
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

