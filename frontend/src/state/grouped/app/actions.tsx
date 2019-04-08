export const TOAST_MESSAGE = 'TOAST_MESSAGE';
export type TOAST_MESSAGE = typeof TOAST_MESSAGE;

interface IToastMessage {
    type: TOAST_MESSAGE;
    message: string;
    color: ToastColor;
}

export const TOAST_COLOR_YELLOW = 'TOAST_COLOR_YELLOW';
export type TOAST_COLOR_YELLOW = typeof TOAST_COLOR_YELLOW;

export const TOAST_COLOR_RED = 'TOAST_COLOR_RED';
export type TOAST_COLOR_RED = typeof TOAST_COLOR_RED;

export const TOAST_COLOR_GREEN = 'TOAST_COLOR_GREEN';
export type TOAST_COLOR_GREEN = typeof TOAST_COLOR_GREEN;

export type ToastColor = TOAST_COLOR_YELLOW | TOAST_COLOR_RED | TOAST_COLOR_GREEN;

export function displayToastMessage(message: string, color?: ToastColor): IToastMessage {
    return {
        type: TOAST_MESSAGE,
        message,
        color: color ? color : TOAST_COLOR_YELLOW,
    };
}

export type IAppAction = IToastMessage;
