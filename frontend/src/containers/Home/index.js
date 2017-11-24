import React, { Component } from 'react'

export default class Home extends Component {
  render () {
    console.log('Homepage props', this.props)

    return (
      <div>
        This is homepage, bros!
      </div>
    )
  }
}
