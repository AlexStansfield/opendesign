import { createStore, combineReducers } from 'redux'
import user from './ducks/user'
/*import createLogger from 'redux-logger'*/

const nullReducer = (state = {}, action) => state

/*const createStoreWithMiddleware = applyMiddleware(createLogger)(createStore)*/

const reducer = combineReducers({
  user,
  projects: nullReducer
})

const configureStore = (initialState, middleware) => createStore(reducer, initialState, middleware)

export default configureStore
