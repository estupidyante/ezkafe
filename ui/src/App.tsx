import { useState } from 'react';
import ReactSearchBox from 'react-search-box';
import {
  Wrapper,
  ContentContainer,
  SimpleButton,
  Header,
  IconContainer,
  Logo,
  LogoLink,
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
  DividerLineTop
} from './lib/Contants';
import { 
  MenuOutline,
  CartOutline,
  SearchOutline,
  ArrowForwardOutline
} from 'react-ionicons';

function App() {
  const [isOrdered, setIsOrdered] = useState(false);

  const handleClickOrder = () => {
    setIsOrdered(!isOrdered);
  };

  const data = [
    {
      key: "john",
      value: "John Doe",
    },
    {
      key: "jane",
      value: "Jane Doe",
    },
    {
      key: "mary",
      value: "Mary Phillips",
    },
    {
      key: "robert",
      value: "Robert",
    },
    {
      key: "karius",
      value: "Karius",
    },
  ];

  return (
    <Wrapper>
      <Header>
        <LogoLink href="#" target="_self">
          <Logo src="/assets/images/ezkafe-base-white.png" alt="EzKafe logo" />
        </LogoLink>
        <IconContainer>
          <CartOutline
            color={'#ffffff'} 
            title={''}
            height="30px"
            width="30px"
          />
          <MenuOutline
            color={'#ffffff'}
            title={''}
            height="30px"
            width="30px"
          />
        </IconContainer>
      </Header>
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
              
              <CardProductItem>
                <CardProduct>
                  <CardProductImage src="/assets/images/products/americano.png" alt="Product Image Name" />
                  <CardProductContent>
                    <CardProductTitle>Product Name</CardProductTitle>
                    <CardProductDescription>Product Description</CardProductDescription>
                    <CardProductPrice value="180.85">Php 180.85</CardProductPrice>
                  </CardProductContent>
                </CardProduct>
              </CardProductItem>

              <CardProductItem>
                <CardProduct>
                  <CardProductImage src="/assets/images/products/amaretto_macchiato.png" alt="Product Image Name" />
                  <CardProductContent>
                    <CardProductTitle>Product Name</CardProductTitle>
                    <CardProductDescription>Product Description</CardProductDescription>
                    <CardProductPrice value="180.85">Php 180.85</CardProductPrice>
                  </CardProductContent>
                </CardProduct>
              </CardProductItem>
  
              <CardProductItem>
                <CardProduct>
                  <CardProductImage src="/assets/images/products/coffee_milk.png" alt="Product Image Name" />
                  <CardProductContent>
                    <CardProductTitle>Product Name</CardProductTitle>
                    <CardProductDescription>Product Description</CardProductDescription>
                    <CardProductPrice value="180.85">Php 180.85</CardProductPrice>
                  </CardProductContent>
                </CardProduct>
              </CardProductItem>

              <CardProductItem>
                <CardProduct>
                  <CardProductImage src="/assets/images/products/espresso_coffee.png" alt="Product Image Name" />
                  <CardProductContent>
                    <CardProductTitle>Product Name</CardProductTitle>
                    <CardProductDescription>Product Description</CardProductDescription>
                    <CardProductPrice value="180.85">Php 180.85</CardProductPrice>
                  </CardProductContent>
                </CardProduct>
              </CardProductItem>

              <CardProductItem>
                <CardProduct>
                  <CardProductImage src="/assets/images/products/espresso_coffee.png" alt="Product Image Name" />
                  <CardProductContent>
                    <CardProductTitle>Product Name</CardProductTitle>
                    <CardProductDescription>Product Description</CardProductDescription>
                    <CardProductPrice value="180.85">Php 180.85</CardProductPrice>
                  </CardProductContent>
                </CardProduct>
              </CardProductItem>

              <CardProductItem>
                <CardProduct>
                  <CardProductImage src="/assets/images/products/espresso_coffee.png" alt="Product Image Name" />
                  <CardProductContent>
                    <CardProductTitle>Product Name</CardProductTitle>
                    <CardProductDescription>Product Description</CardProductDescription>
                    <CardProductPrice value="180.85">Php 180.85</CardProductPrice>
                  </CardProductContent>
                </CardProduct>
              </CardProductItem>
    
            </CardProductLists>
          </Container>
        </CardProductContainer>}
        {!isOrdered && <Section>
          <Button kind={''} onClick={handleClickOrder}>Order Now</Button>
        </Section>}
        <Section>
          <DividerLineTop></DividerLineTop>
        </Section>
      </ContentContainer>
      
      <Footer>
        <FooterTop>
          <FooterBrand>

          </FooterBrand>
        </FooterTop>
      </Footer>

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
