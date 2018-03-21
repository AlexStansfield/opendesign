import React, {Component} from 'react'
import { Link } from 'react-router-dom'
import logo from '../../logo_horizontal.svg';
import {Container, Menu} from 'semantic-ui-react'
import './header.css'

export default class Header extends Component {
    state = {activeItem: 'home'};
    handleItemClick = (e, {name}) => this.setState({activeItem: name});

    render() {
        const {activeItem} = this.state;
        return (
            <Menu pointing fixed='top' size='large' inverted>
                <Container>
                    <Link to='/'>
                      <Menu.Item name='Home' active={activeItem === 'Home'} onClick={this.handleItemClick} className='header-logo'>
                        <img src={logo} className="OpenDesign-Logo" alt="OpenDesign" />
                      </Menu.Item>
                    </Link>
                    <Menu.Menu position='right'>
                        <Menu.Item name='Resources' active={activeItem === 'Resources'}
                                   onClick={this.handleItemClick} />
                        <Menu.Item name='about-us' active={activeItem === 'about-us'}
                                   onClick={this.handleItemClick} />
                        <Menu.Item name='community-guidelines' active={activeItem === 'community-guidelines'}
                                   onClick={this.handleItemClick}/>
                        <Menu.Item name='login-with-github' active={activeItem === 'login-with-github'}
                                   onClick={this.handleItemClick} className={'login-with-github'}>
                            <Link to='/login'>
                                Login with Github
                            </Link>
                        </Menu.Item>
                    </Menu.Menu>
                </Container>
            </Menu>
        )
    }
}
