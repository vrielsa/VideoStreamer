import {useTranslation} from "react-i18next";

export function getAvailableLanguages(): string[] {
    return ["nl", "en"];
}

export function getLocalizedPath(path: string): string {
    return `/${getLocale()}${path}`;
}

export function getLocale(): string {
    const { i18n } = useTranslation();

    return i18n.language;
}