import { InputHTMLAttributes } from "react";

export interface IOption {
  id?:BigInteger;
  label?: string;
  name?: string;
  value?: string;
  disabled?: boolean;
}

export interface IInputGroup {
  group: string;
  label: string;
  ing?:string;
  options: IOption[];
  hasFullWidth?: boolean;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

export interface InputElementProps
  extends InputHTMLAttributes<HTMLInputElement> {
  label: string;
  id: string;
  error?: boolean;
  disabled?: boolean;
}
