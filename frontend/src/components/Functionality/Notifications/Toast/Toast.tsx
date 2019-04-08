import * as React from 'react';
import * as uuid from 'uuid';
import _container from './_container';
import {TOAST_COLOR_YELLOW, ToastColor} from "../../../../state/grouped/app/actions";

interface IProps {
    readonly errorMessage: string;
    readonly toastMessage: string;
    readonly toastColor: ToastColor;
}

interface IState {
    readonly toastMessages: ReadonlyArray<IToastMessage>;
}

interface IToastMessage {
    readonly message: string;
    readonly color: ToastColor;
    readonly id: string;
}

class Toast extends React.Component<IProps, IState> {
    public state = {
        toastMessages: []
    };

    public componentWillReceiveProps(nextProps: Readonly<IProps>, nextContext: any): void {
        if (this.props.errorMessage !== nextProps.errorMessage && nextProps.errorMessage) {
            const {toastMessages} = this.state;
            this.setState({
                toastMessages: [
                    ...toastMessages,
                    {
                        message: nextProps.errorMessage,
                        color: TOAST_COLOR_YELLOW,
                        id: uuid(),
                    }
                ]
            });
            setTimeout(() => {
                this.setState({toastMessages: this.state.toastMessages.slice(1)});
            }, 5000);
        }
        if (this.props.toastMessage !== nextProps.toastMessage && nextProps.toastMessage) {
            const {toastMessages} = this.state;
            this.setState({
                toastMessages: [...toastMessages, {
                    message: nextProps.toastMessage,
                    color: nextProps.toastColor,
                    id: uuid(),
                }]
            });
            setTimeout(() => {
                this.setState({toastMessages: this.state.toastMessages.slice(1)});
            }, 5000);
        }
    }

    public render() {
        const {toastMessages} = this.state;
        return (
            <ul>
                {toastMessages.map((toast: IToastMessage) => (
                    <li key={toast.id}>
                        {toast.message}
                    </li>
                ))}
            </ul>
        );
    }
}

export default _container(Toast);