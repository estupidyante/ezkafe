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

const RadioButtonGroup = ({ label, group, ing, prod_id, options, onChange }: IInputGroup) => {
  function renderOptions() {
    return options.map(({ name, id, price, disabled }: IOption, index) => {
      const shortenedOptionGroupLabel = group.replace(/\s+/g, "").toLowerCase();
      const shortenedOptionLabel = (label) ? label.replace(/\s+/g, "") : name?.replace(/\s+/g, "").toLowerCase();
      const optionId = `radio-option-${shortenedOptionLabel}-${shortenedOptionGroupLabel}`;

      const modifyName = name?.replace(/\s+/g, "").toLowerCase();
      const modifyIng = ing?.replace(/\s+/g, "").toLowerCase();

      return (
        <RadioButton
          key={index}
          value={prod_id + '_' + id}
          label={(label) ? label : name}
          key={optionId}
          id={optionId}
          name={shortenedOptionGroupLabel}
          disabled={disabled}
          defaultChecked={(name && ing) ? modifyIng === modifyName : index === 0}
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
