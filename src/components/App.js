import React        from 'react';

import $            from "jquery";
import Popper       from "popper.js";
import "bootstrap/dist/js/bootstrap.bundle.min";
import '../resources/stylesheet/style.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import Header       from './app_components/Header';
import LoginForm    from './app_components/LoginForm';

class App extends React.Component {

  render() {
    return (
      <div className="app bg-dark">
        <Header/>
        <LoginForm/>
      </div>
    );
  }
}

export default App;