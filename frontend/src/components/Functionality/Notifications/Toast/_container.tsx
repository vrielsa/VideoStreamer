import {connect} from 'react-redux';
import {IStoreState} from "../../../../state/types";
import {ToastColor} from "../../../../state/grouped/app/actions";

interface IStateProps {
    readonly errorMessage: string;
    readonly toastMessage: string;
    readonly toastColor: ToastColor;
}

export function mapStateToProps({appState: {errorMessage, toastMessage: {message, color,}}}: IStoreState): IStateProps {
    return {
        errorMessage,
        toastMessage: message,
        toastColor: color,
    };
}

export function mapDispatchToProps() {
    return {};
}


export default connect<IStateProps, {}, {}>(mapStateToProps, mapDispatchToProps);