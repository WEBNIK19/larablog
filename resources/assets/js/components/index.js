import Vue from 'vue';
import CxltToastr from 'cxlt-vue2-toastr';
import VeeValidate, { Validator } from 'vee-validate';

import en from '../lang/en/en';
import he from '../lang/he/he';
import validationEn from '../lang/en/validator';
import validationHe from '../lang/he/validator';
import validationRu from '../lang/he/validator';

const toastrConfigs = {
    position: 'bottom left',
    showDuration: 1000,
    timeOut: 7500,
};

Validator.extend('login', {
    messages: {
        en() {
            return en.translation.userNotExistCredentials;
        },
        he() {
            return he.translation.userNotExistCredentials;
        },
        ru() {
            return ru.translation.userNotExistCredentials;
        },
    },
    async validate(value) {
        return {
            valid: value !== 0,
        };
    },
    getMessage: field => `The ${field} value is not truthy.`,
});

Validator.extend('unique', {
    messages: {
        en() {
            return en.translation.emailAlreadyExists;
        },
        he() {
            return he.translation.emailAlreadyExists;
        },
        ru() {
            return ru.translation.emailAlreadyExists;
        },
    },
    async validate(value) {
        return {
            valid: value !== 0,
        };
    },
    getMessage: field => `The ${field} value is not truthy.`,
});

Vue.use(CxltToastr, toastrConfigs);

Vue.use(VeeValidate, {
    fieldsBagName: 'fieldsValidation',
    locale: (localStorage.getItem('locale') === null) ? 'en' : localStorage.getItem('locale'),
    dictionary: {
        en: validationEn,
        he: validationHe,
        ru: validationRu,
    },
});
