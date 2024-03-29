import styled, { keyframes } from 'styled-components';

const logoSpinAnime = keyframes`
	from { transform: rotate(0deg); }
	to { transform: rotate(360deg); }
`;

const Wrapper = styled.div`
  background: #F1DEC9;
  max-width: 1280px;
  min-height: 620px;
  margin: 0 auto;
  text-align: center;
`;

const ContentContainer = styled.div`
  padding-top: 100px;
`;

const SimpleButton = styled.button`
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:10px;
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
  width:60px;
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
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  border-radius: 10px;
  position: relative;
  border:1px solid #26140D;
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

const CardHeroContainer = styled.div`
  max-width: 650px;
  width: 50%;
  padding-inline: 15px;
  display: flex;
  flex-wrap: wrap;
`;

const CardHero = styled.section`
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

const Section = styled.section`
  display: flex;
  align-items:center;
  justify-content:space-between;
  flex-wrap: wrap;
  padding: 0 1.2em 1.2em;
`;

const CardHeroTitle = styled.h2`
  color:#ffffff;
  margin-bottom: 10px;
  width:100%;
  text-align:start;
  font-family: 'Josefin Sans', sans-serif;
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
  width:100%;
`;

const TextSpan = styled.span`
  align-self:center;
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

const CardProductContainer = styled.section`
  margin-bottom: 1.2em;
`;

const CardProductLists = styled.ul`
  display: grid;
  gap: 50px 25px;
  grid-template-columns: repeat(1, 1fr);

  @media only screen and (min-width: 420px) {
    grid-template-columns: repeat(2, 1fr);
  }

  @media only screen and (min-width: 575px) {
    grid-template-columns: repeat(4, 1fr);
  }

  @media only screen and (max-width: 991) and (min-width: 767px) {
    grid-template-columns: repeat(4, 1fr);
  }

  @media only screen and (min-width: 992px) {
    grid-template-columns: repeat(4, 1fr);
  }

  @media only screen and (min-width: 1200px) {
    grid-template-columns: repeat(6, 1fr);
  }
`;

const CardProductItem = styled.li`
  background: #ffffff;
  border:1px solid #99918E;
  border-radius: 20px;
  width:160px;
  height:280px;
  box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -webkit-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -moz-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);

  @media only screen and (min-width: 340px) {
    width:320px;
    height:380px;
  }

  @media only screen and (min-width: 375px) {
    width:340px;
    height:410px;
  }

  @media only screen and (min-width: 376px) {
    width:380px;
    height:480px;
  }

  @media only screen and (max-width: 395px) and (min-width: 377px) {
    width:350px;
    height:410px;
  }

  @media only screen and (min-width: 420px) {
    width:180px;
    height:280px;
  }

  @media only screen and (min-width: 575px) {
    width:180px;
  }

  @media only screen and (min-width: 720px) {
    width:168px;
    height: 270px;
  }

  @media only screen and (max-width: 991px) and (min-width: 767px) {
    width:165px;
    height: 270px;
  }

  @media only screen and (min-width: 992px) {
    width:180px;
    height: 270px;
  }

  @media only screen and (min-width: 1200px) {
    width:180px;
    height: 270px;
  }
`;

const CardProduct = styled.div`
  display: flex;
  flex-flow: wrap;
  justify-content: center;
  height:100%;
  position:relative;
`;

const CardProductImage = styled.img`
  height:50%;
  margin-top:1rem;
`;

const CardProductContent = styled.div`
  position:absolute;
  bottom:20px;
  width:100%;
  padding:1rem;
`;

const CardProductTitle = styled.h3`
  font-family: 'Cormorant Garamond', sans-serif;
  text-align: left;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
`;

const CardProductDescription = styled.p`
  font-family: 'Cormorant Garamond', serif;
  text-align:left;
  font-size:1.2rem;
  margin-bottom: 1.5rem;
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
`;
const CardProductPrice = styled.data`
  width: 100%;
  text-align: right;
  display: block;
  padding-right: 10px;
`;

const OrderButton = styled.button`
  font-weight:bolder;
  font-size:2rem;
  width: 100%;
  padding: 2rem;
  background: white;
  border-radius: 20px;
  box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -webkit-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
  -moz-box-shadow: 0px 10px 10px 0px rgba(38,20,13,0.30);
`;

const SwitchButton = styled.button`
  flex: 1 1 0px;
  height: 50px;
  border-radius: 20px;
`;

const Footer = styled.footer`
  color: #888;
  background: #26140D;
  width:100%;
  min-height:200px;
`;

const FooterTop = styled.div`
  color: #888;
`;

const FooterBrand = styled.div`
  display: flex;
  align-items: center;
  margin: auto;
  justify-content: center;
  padding-top: 5rem;
  span {
    margin-left:1rem;
    margin-right:1rem;
  }
`;

const FooterBottom = styled.div`
  margin: auto;
  padding: 5rem;
`;

const DividerLineTop = styled.div`
  border-top:1px solid #26140D;
  width:100%;
`;

const AllProductContainer = styled.div`
  display: flex;
  width: 100%;
  align-items: center;
  margin-top: 10px;
  margin-bottom: 10px;
`;
const AllProductImage = styled.img`
  max-width: 80px;
  max-height: 120px;
`;
const AllProductContentContainer = styled.div`
  text-align: start;
  width:80%;
`;
const AllProductTitle = styled.p`
  font-family: 'Cormorant Garamond', sans-serif;
  font-size:1.5rem;
  margin-top: 10px;
  margin-bottom: 15px;
`;
const AllProductDescription = styled.p`
  font-family: 'Playfair Display', sans-serif;
  font-size:1rem;
  margin-top: 10px;
  margin-bottom: 10px;
`;
const AllProductPrice = styled.p`
  font-family: 'Cormorant Garamond', sans-serif;
  font-size:1.2rem;
  margin-top: 10px;
  margin-bottom: 10px;
`;


export {
  AllProductContainer,
  AllProductImage,
  AllProductContentContainer,
  AllProductTitle,
  AllProductDescription,
  AllProductPrice,
  logoSpinAnime,
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
  CardContainer,
  Card,
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
  SwitchButton,
  Footer,
  FooterTop, 
  FooterBrand,
  FooterBottom,
  DividerLineTop
};