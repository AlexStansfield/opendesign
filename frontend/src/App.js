import React, { Component } from 'react'
import { Container } from 'semantic-ui-react'
import Header from './components/Header'
import Main from './components/Main'


class App extends Component {
  render() {
    return (
        <Container style={{ marginTop: '4em' }}>
        <Header />
        <Main />
      </Container>
    );
  }
}

export default App;
