import RadioButtonGroup from "components/Radio/RadioButtonGroup";
import { memo, useEffect } from "react";

const CurrentProduct = ({ types, ingredients, measurement, handleChange }) => {

  useEffect(() => {
    // console.log("types: " + types);
  }, [types]);

  useEffect(() => {
    // console.log("ingredient: " + ingredients);
  }, [ingredients]);

  useEffect(() => {
    console.log("measurement: " + measurement[0]);
  }, [measurement]);

  useEffect(() => {
    // console.log("handleChange: " + handleChange);
  }, [handleChange]);

  const currentProduct = ingredients.map((ingredient, idx) => {
        return(
            <div key={idx} style={{padding:'1rem',borderColor:'#26140D',borderWidth:1,borderBottomStyle:'solid',}}>
                <p style={{fontSize:'x-large',fontWeight:'bolder',textAlign:'left',display:'flex',justifyContent:'space-between',}}>
                    <span>
                        {
                            types.map((type: { id: any; name: any;}, i: any) => {
                                if (type.id == ingredient.types_id) return type.name
                            })
                        }
                    </span>
                    <span>{ingredient.name}</span>
                </p>
                {(!measurement && !measurement[0]) && <p style={{marginBottom:20,textAlign:'right'}}>{ ingredient.measurement } { ingredient.unit }</p>}
                {(measurement && measurement[0]) && <p style={{marginBottom:20,textAlign:'right'}}>{ measurement[0].value } { measurement[0].unit }</p>}
            </div>
        )
    });

  return (currentProduct);
};

export default memo(CurrentProduct);
