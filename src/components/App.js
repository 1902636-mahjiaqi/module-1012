import React        from 'react';

import $            from "jquery";
import Popper       from "popper.js";
import "bootstrap/dist/js/bootstrap.bundle.min";
import '../resources/stylesheet/style.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import Header       from './app_components/Header';
import LoginForm    from './app_components/LoginForm';

import { BrowserRouter as Router } from 'react-router-dom';
import Route from 'react-router-dom/Route';

class App extends React.Component {

  render() {
    return (
      <Router>
        <div className="app bg-dark">
          {/* insert route here */}
          
          {/* login page */}
          <Route path="/" exact={ true } render={
            ()=> { return (
                <div>
                  <Header/>
                  <LoginForm/>
                </div>
              )}
          }/>

          {/* student home page here - gamified system */}
          <Route path="/home" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/>

          {/* student feedback page */}
          <Route path="/feedback" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/>     
          
          {/* professor manage module page */}
          <Route path="/manage-module" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/> 

          {/* professor create module page */}
          <Route path="/create-module" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/> 

          {/* professor create component page */}
          <Route path="/create-component" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/> 

          {/* professor manage class list page */}
          <Route path="/manage-class" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/> 


          {/* administrator account page */}
          <Route path="/account" render={
            ()=> { return (
                <div>
                  <Header/>
                  {/* insert page content here */}
                </div>
              )}
          }/> 
 
        </div>
      </Router>
    );
  }
}

export default App;