import {Action} from '../../actions';
import {IAppState, initialAppState} from "../../types/appState";
import {TOAST_MESSAGE} from './actions';

export function appReducer(state: IAppState, action: Action): IAppState {
    switch (action.type) {
        case TOAST_MESSAGE:
            return {
                ...state,
                toastMessage: {
                    message: action.message,
                    color: action.color,
                },
            };
    }
    return initialAppState;
}