import {SagaMiddleware} from 'redux-saga';

const sagas: ReadonlyArray<any> = [

];

export function registerWithMiddleware(middleware: SagaMiddleware<any>) {
    sagas.forEach((saga) => {
        middleware.run(saga);
    });
}