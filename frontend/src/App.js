import React, { Component } from 'react'
import { Provider } from 'react-redux'
import { Container } from 'semantic-ui-react'
import Header from './components/Header'
import Main from './components/Main'


class App extends Component {
  render() {
    return (
      <Provider store={this.props.store}>
        <Container style={{ marginTop: '4em' }}>
          <Header />
          <Main />
        </Container>
      </Provider>
    );
  }
}

export default App;
