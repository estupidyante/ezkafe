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
import Accordion from 'components/Accordion/Accordion';

export const FAQsPage = ({handleState}) => {
    const [accordionItems, setAccordionItems] = useState(Array);

    useEffect(() => {
        API.get('faqs')
            .then((response: any) => {
                setAccordionItems(response);
            }).finally(() => {
                console.log('accordionItems: ', accordionItems);
            })
    }, []);

    return (
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
            <Accordion items={accordionItems} />
        </FAQsContainer>
    )
}

const FAQsContainer = styled.div`
    background: #ffffff;
    width: 100%;
    height: 100%;
`;