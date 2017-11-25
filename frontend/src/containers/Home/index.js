import React, { Component } from 'react'
import { Container, Header, Grid, Button, Item, Image } from 'semantic-ui-react'
import { actions } from '../../redux/ducks/projects'
import { connect } from 'react-redux'
import './home.css'

class Home extends Component {
  render () {
    this.props.callApi()
    return (
      <Container>
        <Header>Welcome to Open Design!</Header>
        <p>Choose a project you would like to contribute some design, helps to, or ... <Button primary>submit a
          new project</Button></p>
        <Item.Group>
          {
            this.props.projects.length < 1 ? null : this.props.projects.map((e, i) => (
              <Container key={i}>
                <Grid columns={3} celled className='projectCard'>
                  <Grid.Row>
                    <Grid.Column width={3} className='image'>
                      <Image floated='left' src={e.avatar}/>
                    </Grid.Column>
                    <Grid.Column width={10}>
                      <Header as='h2'>
                        {e.name}
                      </Header>
                      <Header as='h3'>
                        Soemthing
                      </Header>
                      {e.description}
                    </Grid.Column>
                    <Grid.Column width={3}>
                      <p><Button fluid basic color='blue' content='Add brief' icon='add'/></p>
                      <p><Button fluid basic color='blue' content='Comment' icon='comment'
                                 label={{as: 'a', basic: true, color: 'blue', pointing: 'left', content: '100'}}/></p>
                      <p><Button fluid basic color='blue' content='View details' icon='add'/></p>
                    </Grid.Column>
                  </Grid.Row>
                </Grid>
              </Container>
            ))
          }
        </Item.Group>
      </Container>
    )
  }
}

const mapStateToProps = state => {
  return {
    projects: state.projects
  }
}

const mapDispatchToProps = dispatch => (
  {
    callApi: () => {
      console.log('called')
      dispatch(actions.requestAllProjects())
    }
  }
)

export default connect(mapStateToProps, mapDispatchToProps)(Home)
