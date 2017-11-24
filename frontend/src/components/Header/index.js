import React, {Component} from 'react'
import { Link } from 'react-router-dom'
import logo from '../../logo.svg';
import {Container, Menu} from 'semantic-ui-react'

export default class Header extends Component {
    state = {activeItem: 'home'};
    handleItemClick = (e, {name}) => this.setState({activeItem: name});

    render() {
        const {activeItem} = this.state;
        return (
            <Menu pointing secondary fixed='top' size='large'>
                <Container>
                    <Link to='/'>
                      <Menu.Item name='Home' active={activeItem === 'Home'} onClick={this.handleItemClick} as='span'>
                        <img src={logo} className="OpenDesign-Logo" alt="OpenDesign" />
                      </Menu.Item>
                    </Link>
                    <Menu.Menu position='right'>
                        <Menu.Item name='Guidelines' active={activeItem === 'Guidelines'}
                                   onClick={this.handleItemClick} />
                        <Menu.Item name='sign-up' active={activeItem === 'sign-up'}
                                   onClick={this.handleItemClick} />
                        <Link to='/login'>
                          <Menu.Item name='login' active={activeItem === 'login'}
                                   onClick={this.handleItemClick} as='span' />
                        </Link>
                    </Menu.Menu>
                </Container>
            </Menu>
        )
    }
}
