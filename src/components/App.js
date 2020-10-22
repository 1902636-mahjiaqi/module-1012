import React from 'react';
import Header from './app_components/Header';
import MainContent from './app_components/MainContent';
import Footer from './app_components/Footer';
import '../resources/stylesheet/style.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import $ from "jquery";
import Popper from "popper.js";
import "bootstrap/dist/js/bootstrap.bundle.min";

function App() {
  return (
    <div>
        <Header />
        <MainContent />
        <Footer />
    </div>
  );
}

export default App