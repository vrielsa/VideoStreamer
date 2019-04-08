import * as React from 'react';
import {useTranslation} from "react-i18next";

function Demo(): JSX.Element {
    const { t } = useTranslation();

    return (
      <h1>{t('Test by Sarah')}</h1>
    );
}

export default Demo;
