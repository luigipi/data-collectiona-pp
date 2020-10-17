import React, { Component, useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import Axios from 'axios';
import Header from './Header';


const Registration = () => {

  const regData = {
    name: '',
    age: '',
    email: '',
    dob: '',
    passport: '',
    relatives: [{
      relatives_name: '',
      relatives_age: '',
      relationship: ''
    }]
  }
  
  

  const [data, setData] = useState(regData)
  const [status, setStatus] = useState(false)
  const [details, setDetails] = useState({})
  const [isLoading, setIsLoading] = useState(false)
  const [isError, setIsError] = useState(false)
  const [msg, setMsg] = useState()
  const [errors, setErrors] = useState({})

  function setStateData(status, details) {
    setStatus(status)
    setDetails(details)
  }

  function hideError() {
    setIsError(false)
  }

  function hideLoader() {
    setIsLoading(false)
  }

  function handleSubmit(event) {
    event.preventDefault();
    setIsLoading(true)

    Axios.post('/api/v1/create-account', data)
    .then(response => {
      if(response.data.status) {
       setStateData(true, response.data.data)
       setIsError(false)
       setIsLoading(false)
      } 
      else {
        setIsError(true)
        hideLoader()
        if(response.data.message === 'error') {
          setMsg('Fill the form correctly and try again')
          return
        }
        setMsg(response.data.message)
      }      
    })
    .catch(err => '')
  }

  function showForm() {
    setStatus(false)
  }

  const removeClick = index => {
    const list = [...data.relatives];
    list.splice(index, 1);
    setData({...data, relatives: list});
  };

  function addMore() {
    setData({
      ...data,
      relatives: [...data.relatives, {relatives_name: '', relatives_age: '', relationship: ''}] 
    })
  }

  function handleInputChange(e, index) {
     const {name, value, newValue, type} = e.target;

    //  const value = type === 'number' ? +newValue : newValue;

     let list  = [...data.relatives]
     let names = ['relatives_name', 'relatives_age', 'relationship'];

      //setTouch({...touch, [name]: true})

     if(names.includes(name)) {
       list[index][name] = value
       setData({...data, relatives: list})
     } else {
       setData({...data, [name]:value})
     }
  }

  const handleBlur = evt => {
    const { name, value } = evt.target;

    
    if(name === 'age') {
      Number(value) < 18 || Number(value) > 65 ? 
      setErrors({...errors, message: 'Age must be between 18 - 65', error: true}) 
      : setErrors({...errors, message: '', error: false}) 
    }
    else {

      value.length == 0 ? 
      setErrors({...errors, message: `The ${name} field is required`, error: true}) 
      : setErrors({...errors, message: ' ', error: false}) 
    
    }   


    console.log('errors', errors)
  };
  
  return (
    <React.Fragment>
      <Header/>
      <div className="container">        
        <div className="row align-items-center justify-content-center mt-4">
          <div className="col-md-7 col-lg-7 bg-white p-4 shadow-sm reg-box">
            {
              isError && msg !== '' ? (
                <div className="alert alert-danger justify-content-between" onClick={hideError}>
                  {msg} <span onClick={hideError} className="right">x</span>
                </div>
              ): null
            }
            { status ? (
              <div className="success-wrapper bg-white p-4 mt-4">
                <div className="text-success">
                  Thank you {details.name} for registering!  <br/>
                  <h6>Your data was successfully submitted.</h6>
                </div>
                  <span className="text-primary button" onClick={showForm}>Return</span>
              </div>
            ): 
            (
              <div>
                <h1>TECHINNOVER DATA COLLECTION TEST</h1>
                <div className="info">
                  Welcome to the Techinnover data collection recruitment test portal.
                </div>
                <form action="#" onSubmit={handleSubmit}>
                  <div className="details">
                    <h5>PERSONAL DETAILS</h5>
                    {
                      errors.error ? (
                        <div className="text-danger">
                          {errors.message}
                        </div>
                      ): null
                    }
                    <div className="row mb-2">
                      <div className="col">
                        <label htmlFor="name">Name:</label>
                        <input 
                          type="text" 
                          name="name" 
                          className="form-control" 
                          placeholder="Name" 
                          required
                          onChange={handleInputChange}
                          onBlur={handleBlur}
                        />
                      </div>
                      <div className="col">
                        <label htmlFor="age">Age:</label>
                        <input 
                          type="number" 
                          name="age" 
                          max={65}
                          min={18}
                          className="form-control" 
                          placeholder="Age" 
                          required
                          onChange={handleInputChange}
                          onBlur={handleBlur}
                        />
                      </div>
                    </div>
                    <div className="row mb-2">
                      <div className="col">
                        <label htmlFor="email">Email Address:</label>
                        <input 
                          type="email" 
                          name="email" 
                          className="form-control" 
                          placeholder="Email address" 
                          required
                          onChange={handleInputChange}
                          onBlur={handleBlur}
                        />
                      </div>
                      <div className="col">
                        <label htmlFor="dob">Date of Birth:</label>
                        <input 
                          type="date" 
                          name="dob" 
                          className="form-control" 
                          placeholder="Date of Birth" 
                          required
                          onChange={handleInputChange}
                          onBlur={handleBlur}
                        />
                      </div>
                    </div>
                    <div className="form-group">
                      <label htmlFor="passport">
                        <span className="mr-2">Passport photograph:</span>
                        <input 
                          type="file" 
                          name="passport"                        
                          onChange={handleInputChange}
                        />
                      </label>
                    </div>
                  </div>
                  <div className="divider"></div>
                  <div className="members">
                    <h5>FAMILY MEMBERS</h5>
                    { data.relatives.map((id, item) => {
                      return (
                        <div className="mb-2 mt-2" key={item}>
                          <span className="badge badge-light badge-circle">
                            #{item}
                          </span>
                          <span className="badge badge-primary" type="button" onClick={ () => removeClick(item)}>
                            Delete
                          </span>
                        <div className="row" >
                          <div className="col">
                            <label htmlFor="name">Name:</label>
                            <input 
                              type="text" 
                              name="relatives_name" 
                              placeholder="Name" 
                              required
                              className="form-control"
                              onChange={ e => handleInputChange(e, item)}    
                              onBlur={handleBlur}                        
                            />
                          </div>
                          <div className="col">
                            <label htmlFor="age">Relationship:</label>
                            <input 
                              type="text" 
                              name="relationship"
                              className="form-control" 
                              placeholder="Relationship" 
                              required
                              key={id}
                              onChange={ e => handleInputChange(e, item)}
                              onBlur={handleBlur}
                            />
                          </div>
                        
                          <div className="col">
                            <label htmlFor="relatives_age">Age:</label>
                            <input 
                              type="text" 
                              name="relatives_age"
                              className="form-control" 
                              placeholder="Age" 
                              required
                              key={id}
                              onChange={ e => handleInputChange(e, item)}                            />
                          </div>
                        
                        </div>                      
                        </div>
                      )
                    })}
                    <div className="text-right">
                      <button type="button" className="btn-sm btn btn-primary" onClick={addMore}>
                        Add more
                      </button>
                    </div>
                  </div>
                  <button className="btn btn-primary btn-lg">
                    Submit
                  </button>
                  {
                    isLoading ? (
                      <span className="ml-3 text-primary">
                        please wait.....
                      </span>
                      // <img src={loader} alt="loader" width="30"/>
                    ) : null
                  }
                </form>
              </div>
            )
            }
          </div>
      </div>
      </div>
    </React.Fragment>
  );
}

export default Registration;


if (document.getElementById('app')) {
  ReactDOM.render(<Registration />, document.getElementById('app'));
}