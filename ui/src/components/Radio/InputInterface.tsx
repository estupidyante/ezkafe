import { InputHTMLAttributes } from "react";

export interface IOption {
  id?:BigInteger;
  label?: string;
  name?: string;
  price?: string;
  volume?: string;
  unit?: string;
  disabled?: boolean;
}

export interface IInputGroup {
  group: string;
  label: string;
  ing?:string;
  preferred?:[];
  prod_id?:BigInteger;
  options: IOption[];
  hasFullWidth?: boolean;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

export interface InputElementProps
  extends InputHTMLAttributes<HTMLInputElement> {
  label: string;
  id: string;
  price?:string;
  error?: boolean;
  ispreferred?: boolean;
  disabled?: boolean;
}
