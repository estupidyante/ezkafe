import {
    AllProductContainer,
    AllProductImage,
    AllProductContentContainer,
    AllProductTitle,
    AllProductDescription,
    AllProductPrice,
} from '../../lib/Contants';
import { 
    AddOutline
} from 'react-ionicons';
import {
    URI,
} from '../../api';
import { NumericFormat } from 'react-number-format';

export function ProductSmallCard({products, handleState, handleSelected}) {
    if (products.length > 0) return(
        <div>
            {products.map((item, i) => {
                return (
                <AllProductContainer key={i}>
                    <div style={{ display: 'flex', alignItems: 'center', marginRight: 20, width: 80,}}>
                        <AllProductImage src={URI + item?.image} alt={item?.name} />
                    </div>
                    <AllProductContentContainer>
                        <AllProductTitle>{item?.name}</AllProductTitle>
                        <AllProductDescription>{item?.description}</AllProductDescription>
                        <AllProductPrice><NumericFormat value={parseInt(item?.price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></AllProductPrice>
                    </AllProductContentContainer>
                    <button style={{backgroundColor:'#26140D', margin: 5, display: 'flex', alignItems: 'center'}} onClick={() => {
                        handleState(true);
                        handleSelected(item);
                    }}>
                    <AddOutline
                        color={'#ffffff'} 
                        title={''}
                        height="30px"
                        width="30px"
                    />
                    </button>
                </AllProductContainer>
                );
            })}
        </div>
    )
    return (<div></div>)
}