import React, { Component } from 'react'

const FormField = props => {
  return (
    <input 
      type={props.type} 
      name={props.name} 
      className="form-control" 
      placeholder={props.placeholder} 
      required={props.required}      
      onChange={props.onChange}                            
    />
  );
}

export default FormField;