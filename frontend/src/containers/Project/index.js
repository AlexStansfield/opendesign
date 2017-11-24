import React, { Component } from 'react'

export default class Project extends Component {
  render () {
    console.log('Props in project page', this.props)

    return(
      <div>
        <h1>This is a project page # {this.props.match.params.id}</h1>
      </div>
    )
  }
}
