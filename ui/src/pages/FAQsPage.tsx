import { useCallback, useEffect, useState } from 'react';
import styled, { keyframes } from 'styled-components';
import LoadingOverlay from 'react-loading-overlay-ts';
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
import Accordion from 'components/Accordion/Accordion';

export const FAQsPage = ({handleState}) => {
    const [isLoading, setIsLoading] = useState(true);
    const [accordionItems, setAccordionItems] = useState(Array);

    useEffect(() => {
        setIsLoading(true);
        API.get('faqs')
            .then((response: any) => {
                setAccordionItems(response);
            }).finally(() => {
                setIsLoading(false);
                console.log('accordionItems: ', accordionItems);
            })
    }, []);

    return (
        <LoadingOverlay
            active={isLoading}
            spinner
            text='Loading... Brewing Coffee...'
            >
            <FAQsContainer>
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
                    <h1 style={{width:'90%'}}>Frequently Asked Questions</h1>
                </div>
                {(accordionItems.length > 0) && <Accordion items={accordionItems} />}
                {(accordionItems.length <= 0) && <p>There is No Frequently Asked Questions Set by the Admin.</p>}
            </FAQsContainer>
        </LoadingOverlay>
    )
}

const FAQsContainer = styled.div`
    background: #ffffff;
    width: 100%;
    height: 100%;
    min-height:620px;
    padding:20px;
`;