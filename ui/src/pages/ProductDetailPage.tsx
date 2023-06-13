import styled, { keyframes } from 'styled-components';
import { 
    CloseOutline,
} from 'react-ionicons';

export const ProductDetailPage = () => {
    return (
        <ProductDetailedContainer>
            <CloseOutline
                color={'#00000'} 
                title={''}
                height="30px"
                width="30px"
                style={{position:'absolute', left: '2rem', top: '2rem'}}
            />
            <p>new page detailed page</p>
        </ProductDetailedContainer>
    )
}

const ProductDetailedContainer = styled.div`
  background: #F1DEC9;
  width: 100%;
    max-height: 1280px;
    z-index: 100;
    padding: 4rem;
    position: absolute;
    top: 0;
    height: 1280px;
`;