import styled from "styled-components";
import { Legend } from "./InputStyles";
import { IInputGroup, IOption } from "./InputInterface";
import RadioButton from "./RadioButton";

const Fieldset = styled.fieldset`
  border: none;
`;

const Wrapper = styled.div`
  padding: 0.5rem;
  display: grid;
  gap: 1rem;
`;

const RadioButtonGroup = ({ label, group, options, onChange }: IInputGroup) => {
  function renderOptions() {
    return options.map(({ label, value, disabled }: IOption, index) => {
      const shortenedOptionGroupLabel = group.replace(/\s+/g, "").toLowerCase();
      const shortenedOptionLabel = label.replace(/\s+/g, "");
      const optionId = `radio-option-${shortenedOptionLabel}-${shortenedOptionGroupLabel}`;

      return (
        <RadioButton
          value={value}
          label={label}
          key={optionId}
          id={optionId}
          name={group}
          disabled={disabled}
          defaultChecked={index === 0}
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
