import React, {Component} from 'react'
import {Switch, Route} from 'react-router-dom'
import './main.css'

import Home from '../../containers/Home'
import Project from '../../containers/Project'
import Login from '../../containers/Login'

export default class Main extends Component {
  render () {
  return (
    <main>
      <Switch>
        <Route exact path='/' component={Home} />
        <Route path='/project/:id' component={Project} />
        <Route path='/login' component={Login} />
      </Switch>
    </main>
  )
  }
}
