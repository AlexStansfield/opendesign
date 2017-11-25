export const types = {
  SEND_GH_CODE_TO_SERVER: 'SEND_GH_CODE_TO_SERVER',
  SAVE_TOKEN_TO_STATE: 'SAVE_TOKEN_TO_STATE'
}

export const initialState = {
  code: '',
  token: ''
}

export const actions = {
  sendGithubCodeToServer: code => {
    return {
      type: types.SEND_GH_CODE_TO_SERVER,
      payload: {
        code
      }
    }
  },

  saveTokenToState : response => {
    return {
      type: types.SAVE_TOKEN_TO_STATE,
      payload: {
        response
      }
    }
  }
}

const reducer = (state = initialState, action) => {
  switch (action.type) {
    case types.SAVE_TOKEN_TO_STATE:
      return {
        ...state,
        token: action.payload.response.access_token
      }
    case types.SEND_GH_CODE_TO_SERVER:
      return {
        ...state,
        code: action.payload.code
      }
    default:
      return state
  }
}

export default reducer

export const getCode = state => state.user.code
export const getToken = state => state.user.token
