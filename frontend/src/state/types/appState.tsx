import {TOAST_COLOR_GREEN, ToastColor} from "../grouped/app/actions";

export interface IToastState {
    readonly message: string;
    readonly color: ToastColor;
}

export interface IAppState {
    readonly toastMessage: IToastState;
    readonly errorMessage: string;
    readonly isFetching: boolean;
}

export const initialAppState: IAppState = {
    toastMessage: {
        message: '',
        color: TOAST_COLOR_GREEN
    },
    errorMessage: '',
    isFetching: false,
};