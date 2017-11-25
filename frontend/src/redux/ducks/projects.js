export const types = {
  REQUEST_ALL_PROJECTS: 'REQUEST_ALL_PROJECTS',
  REQUEST_ALL_PROJECTS_SUCCESS: 'UPDATE_PROJECTS_STATE'
}

export const initialState = []

export const actions = {
    requestAllProjects: () => {
      console.log('not called?')
      return {
        type: types.REQUEST_ALL_PROJECTS
      }
    },

  requestAllProjectsSucceed : response => {
    console.log('token', response)
    return {
      type: types.REQUEST_ALL_PROJECTS_SUCCESS,
      payload: {
        response
      }
    }
  }
}

const reducer = (state = initialState, action) => {
  switch (action.type) {
    case types.REQUEST_ALL_PROJECTS_SUCCESS:
      return [
        ...state,
        action.payload.response
      ]
    case types.REQUEST_ALL_PROJECTS:
    default:
      return state
  }
}

export default reducer

export const getProjects = state => state.projects
