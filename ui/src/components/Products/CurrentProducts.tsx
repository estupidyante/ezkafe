import { API } from "api";
import RadioButtonGroup from "components/Radio/RadioButtonGroup";
import { useEffect, useState } from "react";

const CurrentProduct = ({ types, ingredients, measurement, isSelected, isFinalSelected, handleChange }) => {
  const [measurements, setMeasurements] = useState(Array);

  useEffect(() => {
    API.get('measurements')
        .then((res_measure) => {
            setMeasurements(res_measure);
        })
  }, []);

  useEffect(() => {
    console.log("types: " + types);
  }, [types]);

  useEffect(() => {
    console.log("ingredient: " + ingredients);
  }, [ingredients]);

  useEffect(() => {
    console.log("measurement: " + measurement);
  }, [measurement]);

  function radioGroupHandler(event: React.ChangeEvent<HTMLInputElement>) {
    let selectedValue = event.target.value;
    handleChange(selectedValue);
    // let selectedMeasurementArr = selectedValue.split('_');
    // let measurement = measurements.filter((measure: {id: any}) => {
    //   return measure.id == parseInt(selectedMeasurementArr[1]);
    // });
    // console.log(measurement[0]);
  }

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
                {
                  (measurement && measurement[0] && !ingredient.measurement) ? (<p style={{marginBottom:20,textAlign:'right'}}>{ measurement[0].volume } { measurement[0].unit }</p>)
                  : (<p style={{marginBottom:20,textAlign:'right'}}>{ ingredient.measurement } { ingredient.unit }</p>)
                }
                {
                  !isFinalSelected && <RadioButtonGroup
                    label="Select the preferred tsp"
                    group={ingredient.name +'_measurement'}
                    preferred={(isSelected) ? '' : (ingredient.measurement + '' + ingredient.unit)}
                    ing={ingredient.measurements_id}
                    prod_id={ingredient.id}
                    options={measurements}
                    onChange={radioGroupHandler}
                />
                }
            </div>
        )
    });

  return (currentProduct);
};

export default CurrentProduct;
