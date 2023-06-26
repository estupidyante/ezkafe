import styled from "styled-components";
import { Legend } from "./InputStyles";
import { IInputGroup, IOption } from "./InputInterface";
import RadioButton from "./RadioButton";
import { NumericFormat } from "react-number-format";

const Fieldset = styled.fieldset`
  border: none;
`;

const Wrapper = styled.div`
  padding: 0.5rem;
  display: grid;
  gap: 1rem;
`;

const RadioButtonGroup = ({ label, group, ing, prod_id, preferred, options, onChange }: IInputGroup) => {
  function renderOptions() {
    return options.map(({ name, id, price, volume, unit, disabled }: IOption, index) => {
      const shortenedOptionGroupLabel = group.replace(/\s+/g, "").toLowerCase();
      const shortenedOptionLabel = name?.replace(/\s+/g, "").toLowerCase();
      const optionId = `radio-option-${shortenedOptionLabel}-${shortenedOptionGroupLabel}`;
      const measurementValue = prod_id + '_' + id;

      return (
        <RadioButton
          key={index}
          value={prod_id + '_' + id}
          label={volume + ' ' + unit}
          id={optionId}
          name={shortenedOptionGroupLabel}
          disabled={disabled}
          defaultChecked={(ing && id) ? id === parseInt(ing) : index === 0}
          ispreferred={(preferred && measurementValue) ? preferred === measurementValue : index === 0}
          price={price}
          onChange={onChange}
        />
      );
    });
  }
  return (
    <Fieldset>
      <Legend>{label}</Legend>
      <Wrapper>{renderOptions()}</Wrapper>
    </Fieldset>
  );
};
export default RadioButtonGroup;
