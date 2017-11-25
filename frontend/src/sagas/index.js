/**
 * Root Saga
 */

import { actions, types } from '../redux/ducks/projects'
import { all, call, take, put, select } from 'redux-saga/effects'
import { getCode, actions as userActions, types as userTypes } from '../redux/ducks/user'

// define watchers
export function * loginFlow () {
  while(true) {
    yield take(userTypes.SEND_GH_CODE_TO_SERVER)
    const code = yield select(getCode)
    console.log('code', code)
    const fetchWrapper = (code) => (fetch('http://localhost:8000/api/auth', {
      method: 'post',
      headers: {
        'Accept': 'application/json, text/plain, *!/!*',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({code: code})
    }).then ((res) => {
      return res.json()
    }).then((res) => {
      return {response: res}
    },(error) => {
      return {error: error.message || 'Something faulty. We have no idea'}
    }))

    const {response, error} = yield call(fetchWrapper, code)

    if (response) {
      yield put(userActions.saveTokenToState(response))
    } else {
      console.log(error);
    }

    yield take('NEVER_CALLED_BECAUSE_NO_LOGOUT')
  }
}


export function * getProjects() {
  while(true) {
    yield take(types.REQUEST_ALL_PROJECTS)
    const fetchWrapper = () => (fetch('http://localhost:8000/api/project').then(res => res.json()).then(
        response => ({response}),
        error => ({error: error.message || 'Something faulty. We have no idea'})
    ))

    const {response, error} = yield call(fetchWrapper)

    if (response) {
      yield  put(actions.requestAllProjectsSucceed(response))
    } else {
      console.log(error);
    }
  }

}

// root saga
export default function * root () {
  yield all([
    getProjects(),
    loginFlow()
    ])
}
