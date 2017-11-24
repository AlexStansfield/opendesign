import React, {Component} from 'react'
import {Container, Header, Grid, Button, Item, Image} from 'semantic-ui-react'
import './home.css'

export default class Home extends Component {
    render() {
        console.log('Homepage props', this.props)

        return (
            <Container>
                <Header>Welcome to Open Design!</Header>
                <p>Choose a project you would like to contribute some design, helps to, or ... <Button primary>submit a
                    new project</Button></p>
                <Item.Group>
                    <Container>
                        <Grid columns={3} celled className='projectCard'>
                            <Grid.Row>
                                <Grid.Column width={3} className='image'>
                                    <Image floated='left' src='https://dummyimage.com/211x164/000000/fff.png'/>
                                </Grid.Column>
                                <Grid.Column width={10}>
                                    <Header as='h2'>
                                        Project #1
                                    </Header>
                                    <Header as='h3'>
                                        Lorem ipsum dolor sit amet
                                    </Header>
                                    Sed bibendum dapibus justo vel egestas. Aliquam erat volutpat. Vivamus eget suscipit
                                    erat, sit amet suscipit est. Fusce a velit facilisis, finibus diam ornare, vehicula
                                    nibh.
                                </Grid.Column>
	                            <Grid.Column width={3}>
		                            <p><Button fluid basic color='blue' content='Add brief' icon='add' /></p>
		                            <p><Button fluid basic color='blue' content='Comment' icon='comment' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '100' }} /></p>
		                            <p><Button fluid basic color='blue' content='View details' icon='add' /></p>
	                            </Grid.Column>
                            </Grid.Row>
                        </Grid>
                    </Container>
	                <Container>
		                <Grid columns={3} celled className='projectCard'>
			                <Grid.Row>
				                <Grid.Column width={3} className='image'>
					                <Image floated='left' src='https://dummyimage.com/211x164/000000/fff.png'/>
				                </Grid.Column>
				                <Grid.Column width={10}>
					                <Header as='h2'>
						                Project #2
					                </Header>
					                <Header as='h3'>
						                Lorem ipsum dolor sit amet
					                </Header>
					                Sed bibendum dapibus justo vel egestas. Aliquam erat volutpat. Vivamus eget suscipit
					                erat, sit amet suscipit est. Fusce a velit facilisis, finibus diam ornare, vehicula
					                nibh.
				                </Grid.Column>
				                <Grid.Column width={3}>
					                <p><Button fluid basic color='blue' content='Add brief' icon='add' /></p>
					                <p><Button fluid basic color='blue' content='Comment' icon='comment' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '100' }} /></p>
					                <p><Button fluid basic color='blue' content='View details' icon='add' /></p>
				                </Grid.Column>
			                </Grid.Row>
		                </Grid>
	                </Container>
	                <Container>
		                <Grid columns={3} celled className='projectCard'>
			                <Grid.Row>
				                <Grid.Column width={3} className='image'>
					                <Image floated='left' src='https://dummyimage.com/211x164/000000/fff.png'/>
				                </Grid.Column>
				                <Grid.Column width={10}>
					                <Header as='h2'>
						                Project #3
					                </Header>
					                <Header as='h3'>
						                Lorem ipsum dolor sit amet
					                </Header>
					                Sed bibendum dapibus justo vel egestas. Aliquam erat volutpat. Vivamus eget suscipit
					                erat, sit amet suscipit est. Fusce a velit facilisis, finibus diam ornare, vehicula
					                nibh.
				                </Grid.Column>
				                <Grid.Column width={3}>
					                <p><Button fluid basic color='blue' content='Add brief' icon='add' /></p>
					                <p><Button fluid basic color='blue' content='Comment' icon='comment' label={{ as: 'a', basic: true, color: 'blue', pointing: 'left', content: '100' }} /></p>
					                <p><Button fluid basic color='blue' content='View details' icon='add' /></p>
				                </Grid.Column>
			                </Grid.Row>
		                </Grid>
	                </Container>
                </Item.Group>
            </Container>
        )
    }
}
