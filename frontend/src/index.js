import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom'
import App from './App'
import registerServiceWorker from './registerServiceWorker';

import './index.css';
import configureStore from './redux/configureStore'
import createSagaMiddleware from 'redux-saga'
import { compose, applyMiddleware } from 'redux'
import rootSaga from './sagas'

const sagaMiddleware = createSagaMiddleware()
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

const store = configureStore({}, composeEnhancers(applyMiddleware(sagaMiddleware)));

sagaMiddleware.run(rootSaga)

ReactDOM.render(
  (<BrowserRouter><App store={store} /></BrowserRouter>),
  document.getElementById('root')
);

registerServiceWorker();
