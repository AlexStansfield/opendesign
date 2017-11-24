import React, {Component} from 'react'
import logo from '../../logo.svg';
import {Container, Menu, Segment} from 'semantic-ui-react'

export default class Header extends Component {
    state = {activeItem: 'home'};
    handleItemClick = (e, {name}) => this.setState({activeItem: name});

    render() {
        const {activeItem} = this.state;
        return (
            <Menu pointing secondary fixed='top' size='large'>
                <Container>
                    <Menu.Item name='Home' active={activeItem === 'Home'} onClick={this.handleItemClick}>
                        <img src={logo} className="OpenDesign-Logo" alt="OpenDesign"/>
                    </Menu.Item>
                    <Menu.Menu position='right'>
                        <Menu.Item name='Guidelines' active={activeItem === 'Guidelines'}
                                   onClick={this.handleItemClick}/>
                        <Menu.Item name='sign-up' active={activeItem === 'sign-up'}
                                   onClick={this.handleItemClick}/>
                        <Menu.Item name='login' active={activeItem === 'login'}
                                   onClick={this.handleItemClick}/>
                    </Menu.Menu>
                </Container>
            </Menu>
        )
    }
}
