import React, {Component} from 'react';
import {BrowserRouter, Route, Switch} from 'react-router-dom';

// import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

import Home from "./pages/Home";

class App extends Component {
  render() {
    return (
      <BrowserRouter>
        <Switch>
          <Route path="/" component={Home} exact/>
        </Switch>
      </BrowserRouter>
    );
  }
}

export default App;
