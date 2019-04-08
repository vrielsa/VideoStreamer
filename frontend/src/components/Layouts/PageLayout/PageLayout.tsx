import * as React from 'react';
import Toast from "../../Functionality/Notifications/Toast/Toast";
import { Layout } from 'antd';

interface IProps {
    readonly children: React.ReactNode;
}

const PageLayout = ({ children }: IProps) => (
    <React.Fragment>
        <Layout>
            {children}
        </Layout>
        <Toast />
    </React.Fragment>
);

export default PageLayout;