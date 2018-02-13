<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $t("translation.register") }}</h3>
                    </div>
                    <div class="panel-body">
                        <div v-if="progress" class="loading"></div>
                        <div class="col-md-12">
                            <form class="form-horizontal" @submit.prevent="setUser">
                                <div :class="{ 'form-group': true, 'has-error': errors.has('name') }">
                                    <label for="name" class="control-label">{{ $t("translation.name") }}</label>
                                    <input id="name" type="text" class="form-control" name="name" v-model="userName" v-validate="'required|max:255'" autofocus>
                                    <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('email') }">
                                    <label for="email" class="control-label">{{ $t("translation.email") }}</label>
                                    <input id="email" type="email" class="form-control" name="email" v-model="userEmail" v-validate="'required|email|max:255'" @input="$validator.validate('email', 1)">
                                    <span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('password') }">
                                    <label for="password" class="control-label">{{ $t("translation.password") }}</label>
                                    <input id="password" type="password" class="form-control" name="password" v-model="userPassword" v-validate="'required|min:6'">
                                    <span v-show="errors.has('password')" class="help-block">{{ errors.first('password') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('passwordConfirmation') }">
                                    <label for="password-confirmation" class="control-label">{{ $t("translation.confirmPassword") }}</label>
                                    <input id="password-confirmation" type="password" class="form-control" name="passwordConfirmation" v-model="userPasswordConfirmation" v-validate="'required|confirmed:password'">
                                    <span v-show="errors.has('passwordConfirmation')" class="help-block">{{ errors.first('passwordConfirmation') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('type_user') }">
                                    <label for="type_user" class="control-label">
                                        {{ $t("translation.type_user") }}
                                    </label>
                                    <select id="type_user" class="form-control" name="type_user" v-model="type_user" v-validate="'required'" >
                                        <option :value="type.id" v-for="type in getAllTypes">{{ type.type }}</option>
                                    </select>
                                    <span v-show="errors.has('type_user')" class="help-block">{{ errors.first('type_user') }}</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="login-btn btn btn-success" :disabled="this.progress">
                                        {{ $t("translation.register") }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import userMixin from '../../mixins/user';

    export default {
        mixins: [
            userMixin,
        ],
        data() {
            return {
                progress: false,
                userName: '',
                userEmail: '',
                userPassword: '',
                userPasswordConfirmation: '',
                type_user: 1,
            };
        },
        mounted() {
            this.$store.dispatch('getAllTypes');
        },
        computed: {
            getAllTypes() {
                return this.$store.getters.allTypes;
            }
        },
        methods: {
            async setUser() {
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    this.progress = true;

                    try {
                        await this.$store.dispatch('setUser', {
                            data: {
                                name: this.userName,
                                email: this.userEmail,
                                password: this.userPassword,
                                password_confirmation: this.userPasswordConfirmation,
                            }
                        });

                        this.$router.push({
                            name: 'user.all',
                        });
                    } catch (e) {
                        this.$validator.validate('email', 0);

                        this.progress = false;
                    }
                }
            },
        },
        created() {
            this.$validator.attach('email', 'unique');
        },
        beforeDestroy() {
            this.password = '';
            this.passwordConfirmation = '';
        },
    };
</script>
