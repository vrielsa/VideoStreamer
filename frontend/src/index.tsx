import * as React from 'react';
import * as ReactDOM from 'react-dom';
import registerServiceWorker from './registerServiceWorker';
import {Provider} from "react-redux";
import {ConnectedRouter} from 'connected-react-router';
import {Route} from "react-router";
import {store, history} from './state';
import RouteIndex from './routes/RouteIndex';
import {displayToastMessage} from "./state/grouped/app/actions";
import './styles/index.css';
import './i18n';

ReactDOM.render(
    <Provider store={store}>
        <ConnectedRouter history={history}>
            <React.Suspense fallback={<h2>Loading</h2>}>
                <Route path="/" component={RouteIndex}/>
            </React.Suspense>
        </ConnectedRouter>
    </Provider>,
    document.getElementById('root')
);

registerServiceWorker({
    onUpdate: () => {
        store.dispatch(displayToastMessage(
            'A new version off the app is available: please reload'
        ));
    },
    onSuccess: () => {
    }
});
