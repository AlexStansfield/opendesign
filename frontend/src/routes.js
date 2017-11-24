import React from 'react';
import { Router, Route } from 'react-router';

import App from './App'
import Project from './containers/Project';

const Routes = (props) => (
  <Router {...props}>
    <Route path="/" component={App} />
    <Route path="/project/:id" component={Project} />
  </Router>
);

export default Routes;
