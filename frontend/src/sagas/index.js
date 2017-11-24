/**
 * Root Saga for Job/Search
 */

import { all,  take, select, put } from 'redux-saga/effects'
import { getCode, actions, types as userTypes } from '../redux/ducks/user'


// define watchers
export function * loginFlow () {
  while(true) {
    yield take(userTypes.SEND_GH_CODE_TO_SERVER)
    const code = yield select(getCode)
    console.log('code', code)
    fetch('http://localhost:8000/api/auth', {
      method: 'post',
      headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({code: code})
    }).then ((res) => {
      return res.json()
    }).then((res) => {
      put(actions.saveTokenToState(res.access_token))
    })

    yield take('NEVER_CALLED_BECAUSE_NO_LOGOUT')
  }
}

// root saga
export default function * root () {
  yield all([
    loginFlow()
  ])
}
