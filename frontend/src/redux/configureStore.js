import { createStore, applyMiddleware, combineReducers } from 'redux'
import createLogger from 'redux-logger'

const nullReducer = (state = {}, action) => state

const createStoreWithMiddleware = applyMiddleware(createLogger)(createStore)

const reducer = combineReducers({
  config: nullReducer,
  entities: nullReducer
})

const configureStore = (initialState) => createStoreWithMiddleware(reducer, initialState)

export default configureStore
