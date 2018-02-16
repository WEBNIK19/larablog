import * as types from '../store/mutation-types';

export default {
    computed: {
        logged() {
            return this.$store.getters.logged;
        },
        name: {
            get() {
                return this.$store.getters.name;
            },
            set(value) {
                this.$store.commit(types.NAME, value);
            },
        },
        email: {
            get() {
                return this.$store.getters.email;
            },
            set(value) {
                this.$store.commit(types.EMAIL, value);
            },
        },
        password: {
            get() {
                return this.$store.getters.password;
            },
            set(value) {
                this.$store.commit(types.PASSWORD, value);
            },
        },
        passwordConfirmation: {
            get() {
                return this.$store.getters.passwordConfirmation;
            },
            set(value) {
                this.$store.commit(types.PASSWORD_CONFIRMATION, value);
            },
        },
        AllTypes: {
            get() {
                return this.$store.getters.allTypes;
            },
            set(value) {
                this.$store.commit(types.ALL_TYPES, value);
            }
        },
        User: {
            get() {
                return this.$store.getters.User;
            },
            set(value) {
                return this.$store.commit.User;
            }
        },
        typeUserId: {
            get() {
                return this.$store.getters.typeUserId;
            },
            set(value) {
                this.$store.commit(types.TYPE_USER_ID, value);
            }
        },
        
    },
};
