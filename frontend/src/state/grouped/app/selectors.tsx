import {IAppState, IToastState} from "../../types/appState";

export const getToastMessage = (appState: IAppState): IToastState => {
    return appState.toastMessage;
};