import React, { Component } from 'react'
import GithubLogin from 'react-github-login'
import { actions, getCode } from '../../redux/ducks/user'
import { connect } from 'react-redux'


class Login extends Component {
  onSuccess = response => {
    console.log('Github Response', response)
    this.props.callApi(response.code)

  }

  onFailure = response => {
    console.log('Github Failed Response', response)
    alert('Oops! We could not log you in!');
  }

  render () {
    return (
      <GithubLogin
        clientId="Iv1.e8d26d36d8eb0ded"
        redirectUri=""
        onSuccess={this.onSuccess}
        onFailure={this.onFailure}
      />
    )
  }
}


const mapStateToProps = (state) => {
  return {
    code: getCode(state)
  }
}

const mapDispatchToProps = (dispatch) => {
  return {
    callApi: (code) => {
      dispatch(actions.sendGithubCodeToServer(code))
    },
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Login)
