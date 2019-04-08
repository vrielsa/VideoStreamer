import {IAppState} from './appState';
import {RouterState} from "connected-react-router";

export interface IStoreState {
    readonly appState: IAppState;
    readonly router: RouterState;
}