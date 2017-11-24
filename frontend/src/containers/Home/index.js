import React, { Component } from 'react'
import { Container } from 'semantic-ui-react'

export default class Home extends Component {
  render () {
    console.log('Homepage props', this.props)

    return (
      <Container>
        This is homepage, bros!
      </Container>
    )
  }
}
