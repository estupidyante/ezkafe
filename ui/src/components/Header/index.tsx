import {
    Header,
    IconContainer,
    Logo,
    LogoLink,
  } from '../../lib/Contants';
  import { 
    MenuOutline,
    CartOutline,
  } from 'react-ionicons';

export const HeaderComponent = () => {
    return (
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
    )
}