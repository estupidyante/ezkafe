import styled from "styled-components";
import { InputElementProps } from "./InputInterface";
import { Label, Radio } from "./InputStyles";
import { NumericFormat } from "react-number-format";
// import { DisabledIcon } from "src/styled-components/Icons";

const Wrapper = styled.div`
  display: flex;
  gap: 0.5rem;
  align-items: center;
`;

const RadioButton = ({ label, id, price, disabled, ispreferred, ...rest }: InputElementProps) => {
  return (
    <Wrapper>
      <Radio id={id} type="radio" disabled={disabled} {...rest} />
      <Label style={{width:'60%',textAlign:'left'}} htmlFor={id} disabled={disabled}>
        <span>{label} </span>
        {/* disabled && <DisabledIcon small /> */}
        {ispreferred && <span> (preferred)</span>}
      </Label>
      {ispreferred && <div style={{width:'40%',textAlign:'right'}}><NumericFormat value={0} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></div>}
      {!ispreferred && <div style={{width:'40%',textAlign:'right'}}><NumericFormat value={parseInt(price)} displayType={'text'} thousandSeparator={true} decimalScale={2} fixedDecimalScale={true} prefix={'Php '} /></div>}
    </Wrapper>
  );
};

export default RadioButton;
