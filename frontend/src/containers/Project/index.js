import React, { Component } from 'react'
import { Container, Image, Grid, Header, Button, Divider, Icon } from 'semantic-ui-react'
import './project.css'

export default class Project extends Component {
  render () {
    console.log('Props in project page', this.props)
    const projectId = this.props.match.params.id

    return(
      <Container className='project-main'>
        <Grid columns={3}>
          <Grid.Row>
            <Grid.Column width={3}>
              <Image
                className='no-padding'
                alt='logo'
                floated='left'
                src='https://placehold.it/221x140'
              />
            </Grid.Column>
            <Grid.Column width={10}>
              <Header>
                Noto-Fonts
              </Header>
              <p>
                Fonts aiming to support all languages with a harmonious look and feel.
              </p>
              <a href='https://github.com/googlei18n/noto-fonts'>https://github.com/googlei18n/noto-fonts</a>
            </Grid.Column>
            <Grid.Column width={3} className='side-links'>
              <p>
                <a href='#'>Share this project</a>
              </p>
              <p>
                <a href='#'>Contact owner</a>
              </p>
              <Button>
                Add a brief
              </Button>
            </Grid.Column>
          </Grid.Row>
          <Divider />
          <Grid.Row centered>
            <Grid.Column width={15}>
              <p>
                When text is rendered by a computer, sometimes characters are displayed as “tofu” (for example: ࡠ).
                They are little boxes to indicate your device doesn’t have a font to display the text.
              </p>
              <p>
                Google has been developing a font family called Noto, which aims to support all languages with a harmonious look and feel.
                Noto is Google’s answer to tofu. The name noto is to convey the idea that Google’s goal is to see “no more tofu”.
                Noto has multiple styles and weights, and is freely available to all.
              </p>
            </Grid.Column>
          </Grid.Row>
          <Divider />
          <Grid.Row centered>
            <Grid.Column>
              <Image
                src='//placehold.it/300x185'
                centered
              />
            </Grid.Column>
            <Grid.Column>
              <Image
                src='//placehold.it/300x185'
                centered
              />
            </Grid.Column>
            <Grid.Column>
              <Image
                src='//placehold.it/300x185'
                centered
              />
            </Grid.Column>
          </Grid.Row>
          <Divider />
          <Grid.Row centered>
            <Grid.Column width={15}>
              Please submit a mockup of your suggestions to improve this flow.
              <Button>
                SUBMIT A MOCKUP
              </Button>
            </Grid.Column>
            <Container>

            </Container>
          </Grid.Row>
          <Divider />
          <Grid.Row centered>
            <Grid.Column width={15}>
              <Header>
                The Submissions
              </Header>

              <Container className='shadowy-card'>
                <Grid columns={3}>
                  <Grid.Row>
                    <Grid.Column width={6}>
                      <Image
                        className='no-padding'
                        alt='logo'
                        centered
                        src='https://placehold.it/300x188'
                      />
                    </Grid.Column>
                    <Grid.Column width={9}>
                      <Header className='push-down-eight'>
                        Submitted by @lance &middot; 10:22pm 11/25/17
                      </Header>
                      <p>
                        I was thinking that there was not enough blue on this page and that maybe it needed a stronger
                        call to action above the fold.
                      </p>
                    </Grid.Column>
                    <Grid.Column width={1}>
                      <Icon name='flag' color='orange' fitted='right'/>
                    </Grid.Column>
                  </Grid.Row>
                  <Grid.Row>
                    <Grid.Column width={16}>
                      <Button fluid basic color='blue' content='Upvote' icon='caret up' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '356' }} />
                      <Button fluid basic color='blue' content='Give Feedback' icon='comment' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '1' }} />
                      <Button fluid basic color='blue' content='Rebound' icon='rebound' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '18' }} />
                      <Button  basic color='blue' content='Approve' />
                      <Button  basic color='blue' content='Full View' icon='plus square outline' />
                    </Grid.Column>
                  </Grid.Row>
                </Grid>
              </Container>

              <Container className='shadowy-card'>
                <Grid columns={3}>
                  <Grid.Row>
                    <Grid.Column width={6}>
                      <Image
                        className='no-padding'
                        alt='logo'
                        centered
                        src='https://placehold.it/300x188'
                      />
                    </Grid.Column>
                    <Grid.Column width={9}>
                      <Header className='push-down-eight'>
                        Submitted by @lance &middot; 10:22pm 11/25/17
                      </Header>
                      <p>
                        I was thinking that there was not enough blue on this page and that maybe it needed a stronger
                        call to action above the fold.
                      </p>
                    </Grid.Column>
                    <Grid.Column width={1}>
                      <Icon name='flag' color='orange' fitted='right'/>
                    </Grid.Column>
                  </Grid.Row>
                  <Grid.Row>
                    <Grid.Column width={16}>
                      <Button fluid basic color='blue' content='Upvote' icon='caret up' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '356' }} />
                      <Button fluid basic color='blue' content='Give Feedback' icon='comment' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '1' }} />
                      <Button fluid basic color='blue' content='Rebound' icon='rebound' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '18' }} />
                      <Button  basic color='blue' content='Approve' />
                      <Button  basic color='blue' content='Full View' icon='plus square outline' />
                    </Grid.Column>
                  </Grid.Row>
                </Grid>
              </Container>

            </Grid.Column>
          </Grid.Row>
        </Grid>
      </Container>
    )
  }
}
