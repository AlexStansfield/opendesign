import React, { Component } from 'react'
import { Provider } from 'react-redux'
import {Grid} from 'semantic-ui-react'
import Header from './components/Header'
import Main from './components/Main'

class App extends Component {
    render() {
        return (
            <Provider store={this.props.store}>
	            <Grid columns={1}>
  	              <Grid.Column>
    	                <Grid.Row style={{marginBottom: '5em'}}>
      	                  <Header/>
        	            </Grid.Row>
          	          <Grid.Row>
            	            <Main/>
              	      </Grid.Row>
                	</Grid.Column>
	            </Grid>
						</Provider>
        );
    }
}

export default App;
