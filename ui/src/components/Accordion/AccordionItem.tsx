import { useEffect, useRef, useState } from 'react';
import { getRefValue } from '../../lib/hooks';
import { AccordionData } from './types';
import './AccordionItem.css';

function AccordionItem({
  data,
  isOpen,
  btnOnClick,
}: {
  data: AccordionData;
  isOpen: boolean;
  btnOnClick: () => void;
}) {
  const contentRef = useRef<HTMLDivElement>(null);
  const [height, setHeight] = useState(0);

  useEffect(() => {
    if (isOpen) {
      const contentEl = getRefValue(contentRef);

      setHeight(contentEl.scrollHeight);
    } else {
      setHeight(0);
    }
  }, [isOpen]);

  return (
    <li className={`accordion-item ${isOpen ? 'active' : ''}`}>
      <h2 className="accordion-item-title">
        <button className="accordion-item-btn" onClick={btnOnClick}>
          {data.name}
        </button>
      </h2>
      <div className="accordion-item-container" style={{ height }}>
        <div ref={contentRef} className="accordion-item-content">
          {
            data.faqs.map((faq, idx) => {
              return(
                <div key={idx}>
                  <p style={{display:'flex'}}><strong>Question: </strong> <span style={{marginLeft:'1rem',textAlign:'left'}}>{faq.question}</span></p>
                  <p style={{display:'flex'}}><strong>Answer: </strong> <span style={{marginLeft:'1rem',textAlign:'left'}}>{faq.answer}</span></p>
                </div>
              )
            })
          }
        </div>
      </div>
    </li>
  );
}

export default AccordionItem;