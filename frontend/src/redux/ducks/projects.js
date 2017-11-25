export const types = {
  REQUEST_ALL_PROJECTS: 'REQUEST_ALL_PROJECTS',
  REQUEST_ALL_PROJECTS_SUCCESS: 'REQUEST_ALL_PROJECTS_SUCCESS'
}

export const initialState = []

export const actions = {
    requestAllProjects: () => {
      return {
        type: types.REQUEST_ALL_PROJECTS
      }
    },

  requestAllProjectsSucceed : response => {
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
      return action.payload.response.projects
    case types.REQUEST_ALL_PROJECTS:
    default:
      return state
  }
}

export default reducer
