import React, { useState } from 'react';
import styles from './Select.module.css';
import { Option } from './SelectInterface';

interface SelectProps {
    placeholder?: string;
    options: Option[];
    selected: Option | null;
    onChange: (selection: Option) => void;
};

export const Select: React.FC<SelectProps> = ({ placeholder, selected, options, onChange }) => {
    const [showOptions, setShowOptions] = useState(false);

    return (
        <div className={styles['select-component']}>
            <div onClick={() => setShowOptions(!showOptions)} className={styles['select']}>
                <span>{selected ? selected.label : placeholder}</span>
                <span>v</span>
            </div>
            {showOptions && (
                <div className={styles['options']}>
                    {options.map(option => (
                        <div onClick={() => {
                            onChange(option);
                            setShowOptions(false);
                        }} key={option.value} className={styles['option']}>
                            <span>{option.label}</span>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};