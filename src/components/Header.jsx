import React, { Component } from 'react';

const Header = () => {
  return (
    <div className="container-fluid  shadow-sm bg-primary">
      <div className="container">            
      <nav className="navbar navbar-expand-md navbar-dark ">
        <a className="navbar-brand" href="#">
          DATA COLLECTION
        </a>
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
      </nav>    
    </div>
    </div>          
  );
}

export default Header;