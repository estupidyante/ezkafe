import { ReactNode } from 'react';

export type AccordionSubData = {
    id: number,
    answer: string,
    question: string,
}

export type AccordionData = {
    name: string;
    faqs: Array<AccordionSubData>;
};