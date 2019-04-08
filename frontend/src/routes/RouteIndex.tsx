import * as React from 'react';
import PageLayout from "../components/Layouts/PageLayout/PageLayout";
import {Redirect, Route, Switch} from "react-router";
import Demo from "./Demo/Demo";
import {getAvailableLanguages, getLocalizedPath} from "../library/locale/locale";

function RouteIndex(): JSX.Element {
    return (
        <PageLayout>
            <Switch>
                <Route path={`/:language(${getAvailableLanguages().join('|')})`}>
                    <Switch>
                        <Route path="/:language/*" component={Demo}/>
                    </Switch>
                </Route>
                <Redirect to={getLocalizedPath('/')}/>
            </Switch>
        </PageLayout>
    );
}

export default RouteIndex;