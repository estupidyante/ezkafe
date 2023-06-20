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

const RadioButtonGroup = ({ label, group, ing, options, onChange }: IInputGroup) => {
  function renderOptions() {
    return options.map(({ name, id, disabled }: IOption, index) => {
      const shortenedOptionGroupLabel = group.replace(/\s+/g, "").toLowerCase();
      const shortenedOptionLabel = (label) ? label.replace(/\s+/g, "") : name?.replace(/\s+/g, "").toLowerCase();
      const optionId = `radio-option-${shortenedOptionLabel}-${shortenedOptionGroupLabel}`;

      const modifyName = name?.replace(/\s+/g, "").toLowerCase();
      const modifyIng = ing?.replace(/\s+/g, "").toLowerCase();

      return (
        <RadioButton
          value={id}
          label={(label) ? label : name}
          key={optionId}
          id={optionId}
          name={shortenedOptionGroupLabel}
          disabled={disabled}
          defaultChecked={(name && ing) ? modifyIng === modifyName : index === 0}
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
