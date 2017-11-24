import React, { Component } from 'react'
import GithubLogin from 'react-github-login'

// response.code has code
// send that to server
const onSuccess = response => console.log('Github Response', response)
const onFailure = response => console.log('Github Failed Response', response)

export default class Login extends Component {
  render () {
    return (
      <GithubLogin
        clientId="Iv1.e8d26d36d8eb0ded"
        redirectUri=""
        onSuccess={onSuccess}
        onFailure={onFailure}
      />
    )
  }
}
