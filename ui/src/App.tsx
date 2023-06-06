import { useState } from 'react';
import ReactSearchBox from 'react-search-box';
import styled, { keyframes } from 'styled-components';
import { 
  MenuOutline,
  CartOutline,
  SearchOutline,
  ArrowForwardOutline
} from 'react-ionicons';

function App() {
  const [count, setCount] = useState(0);

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
          <Container>
            <CardHeroTitle>
              Best Seller<br/>
              <strong>of the week</strong>
            </CardHeroTitle>
            <CardHeroText>
              <span>Hot Butterscotch</span>
              <span>Latte</span>
            </CardHeroText>
            <CardHeroButton>
              <span>More Info</span>
              <ArrowForwardOutline
                color={'#ffffff'}
                title={''}
                height="18px"
                width="18px"
              />
            </CardHeroButton>
          </Container>
        </CardHero>
        <h1>EzKafe UI</h1>
        <CardContainer>
          <Card>
            <button onClick={() => setCount(count => count + 1)}>count is {count}</button>
            <p>
              Edit <code>src/App.tsx</code> and save to test HMR
            </p>
          </Card>
          <Card>
            <button onClick={() => setCount(count => count + 1)}>count is {count}</button>
            <p>
              Edit <code>src/App.tsx</code> and save to test HMR
            </p>
          </Card>
          <Card>
            <button onClick={() => setCount(count => count + 1)}>count is {count}</button>
            <p>
              Edit <code>src/App.tsx</code> and save to test HMR
            </p>
          </Card>
          <Card>
            <button onClick={() => setCount(count => count + 1)}>count is {count}</button>
            <p>
              Edit <code>src/App.tsx</code> and save to test HMR
            </p>
          </Card>
        </CardContainer>
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

const logoSpinAnime = keyframes`
	from { transform: rotate(0deg); }
	to { transform: rotate(360deg); }
`;

const Wrapper = styled.div`
  background: #F1DEC9;
  max-width: 1280px;
  margin: 0 auto;
  text-align: center;
  padding-top: 100px;
`;

const ContentContainer = styled.div`

`;

const Header = styled.header`
  display: flex;
  align-items: center;
  justify-content:space-between;
  background: #5B3216;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  transition: var(--transition-1);
  padding: 1.2em;
  z-index: 4;
`;
const IconContainer = styled.div`
  width: 80px;
  display: flex;
  justify-content: space-between;
`;
const Logo = styled.img`
  width:160px;
  will-change: filter;

  &:hover {
    filter: drop-shadow(0 0 2em #646cffaa);
  }
`;

const LogoLink = styled.a`
  @media (prefers-reduced-motion: no-preference) {
    &:nth-of-type(2) ${Logo} {
      animation: ${logoSpinAnime} infinite 20s linear;
    }
  }
`;

const SearchContainer = styled.div`
  margin: 1.2em;
  height: 40px;
  background: transparent;
  position: relative;
`;

const SearchBoxContainer = styled.div`
  width:100%;
`;

const SearchIconContainer = styled.div`
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  position: absolute;
  right: 5px;
  top: 5px;
`;

const CardHero = styled.div`
  background-repeat: no-repeat;
  background-size: cover;
  background-position: left;
  min-height: 250px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin: 2em 1.2em;
  background: #26140D;
  border-radius: 10px;
  box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -webkit-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -moz-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
`;

const Container = styled.div`
  max-width: 650px;
  width: 100%;
  padding-inline: 15px;
  display: flex;
  flex-wrap: wrap;
`;
const CardHeroTitle = styled.h2`
  color:#ffffff;
  margin-bottom: 10px;
  width:100%;
  text-align:start;
`;
const CardHeroText = styled.p`
  color: #ffffff;
  font-family: 'Roboto', sans-serif;
  font-size: 2rem;
  line-height: 1.8;
  max-width: 46ch;
  margin-bottom: 25px;
  text-align: start;
  width:100%;
`;

const CardHeroButton = styled.div`
  color: #ffffff;
  font-size: 1.2rem;
  display: flex;
  gap: 10px;
`;

const CardContainer = styled.div`
  display:flex;
  gap: 20px;
`;

const Card = styled.div`
  background: rgb(255, 255, 255);
  border-radius: 20px;
  height: 300px;
  width: 200px;
  border-radius: 10px;
  box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -webkit-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -moz-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
`;

const Footer = styled.footer`
  color: #888;
  background: #26140D;
  width:100%;
  height:200px;
`;

const FooterTop = styled.div`
  color: #888;
`;

const FooterBrand = styled.div`
`;

export default App;
