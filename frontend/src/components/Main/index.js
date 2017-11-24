import React, {Component} from 'react'
import {Switch, Route} from 'react-router-dom'

import Home from '../../containers/Home'
import Project from '../../containers/Project'

export default class Main extends Component {
  render () {
  return (
    <main>
      <Switch>
        <Route exact path='/' component={Home} />
        <Route path='/project/:id' component={Project} />
      </Switch>
    </main>
  )
  }
}
