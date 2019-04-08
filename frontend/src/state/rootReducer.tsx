
import {IAppState, initialAppState} from "./types/appState";
import {combineReducers} from "redux";
import {IStoreState} from "./types";
import {appReducer} from "./grouped/app/reducer";
import reduceReducers from 'reduce-reducers';
import {connectRouter} from "connected-react-router";

const reducedReducer = reduceReducers<IAppState>(
    initialAppState,
    appReducer,
);

export default (history: any) => combineReducers<IStoreState>({
    appState: reducedReducer,
    router: connectRouter(history)
});
