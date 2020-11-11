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

          {/* register page */}
          <Route path="/register" render={
            ()=> { return (
                <div>
                  <Header/>
                  <h1>insert register form here</h1>
                </div>
              )}
          }/>

        </div>
      </Router>
    );
  }
}

export default App;