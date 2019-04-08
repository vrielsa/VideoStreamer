import { routerMiddleware} from "connected-react-router";
import { applyMiddleware, compose, createStore, Store } from "redux";
import { createBrowserHistory } from "history";
import createSagaMiddleware from "redux-saga";
import { IStoreState } from "src/state/types";
import rootReducer from "./rootReducer";
import { registerWithMiddleware } from "./sagaSetup";

const history = createBrowserHistory();
const sagaMiddleware = createSagaMiddleware();

const middleware = [
  sagaMiddleware,
  routerMiddleware(history)
];

const storeDevelop = () => {
    const composeEnhancers =
        typeof window === 'object' &&
        (window as any).__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ ?
            (window as any).__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({
                // Specify extension’s options like name, actionsBlacklist, actionsCreators, serialize...
            }) : compose;

    return createStore<IStoreState, any, any, any>(
        rootReducer(history),
        composeEnhancers(applyMiddleware(...middleware)),
    );
};

const storeProduction = () => createStore<IStoreState, any, any, any>(
    rootReducer(history),
    compose(applyMiddleware(...middleware))
);

const store: Store<IStoreState> = process.env.NODE_ENV === 'production' ? storeProduction() : storeDevelop();
registerWithMiddleware(sagaMiddleware);

export {store, history};
