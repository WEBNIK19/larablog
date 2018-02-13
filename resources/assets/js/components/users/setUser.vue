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
                            <form class="form-horizontal" @submit.prevent="register">
                                <div :class="{ 'form-group': true, 'has-error': errors.has('name') }">
                                    <label for="userName" class="control-label">{{ $t("translation.name") }}</label>
                                    <input id="userName" type="text" class="form-control" name="userName" v-model="userName" v-validate="'required|max:255'" autofocus>
                                    <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('userEmail') }">
                                    <label for="userEmail" class="control-label">{{ $t("translation.email") }}</label>
                                    <input id="userEmail" type="email" class="form-control" name="userEmail" v-model="userEmail" v-validate="'required|email|max:255'" @input="$validator.validate('email', 1)">
                                    <span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('userPassword') }">
                                    <label for="userPassword" class="control-label">{{ $t("translation.password") }}</label>
                                    <input id="userPassword" type="password" class="form-control" name="userPassword" v-model="userPassword" v-validate="'required|min:6'">
                                    <span v-show="errors.has('userPassword')" class="help-block">{{ errors.first('userPassword') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('userPasswordConfirmation') }">
                                    <label for="userPasswordConfirmation" class="control-label">{{ $t("translation.confirmPassword") }}</label>
                                    <input id="userPasswordConfirmation" type="password" class="form-control" name="userPasswordConfirmation" v-model="userPasswordConfirmation" v-validate="'required|confirmed:password'">
                                    <span v-show="errors.has('userPasswordConfirmation')" class="help-block">{{ errors.first('userPasswordConfirmation') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('typeUserId') }">
                                    <label for="typeUserId" class="control-label">{{ $t("translation.typeUserId") }}</label>
                                    <select id="typeUserId" name="typeUserId" class="form-control" v-model="typeUserId" v-validate="'required'">
                                        <option ></option>
                                    </select>
                                    <span v-show="errors.has('typeUserId')" class="help-block">{{ errors.first('typeUserId') }}</span>
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
            };
        },
        computed: {
            allTypes() {
                return this.$store.getters.allTypes;
            },
        },
        methods: {
            async setUser() {
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    this.progress = true;

                    try {
                        await this.$store.dispatch('setUser', {
                            name: this.userName,
                            email: this.userEmail,
                            password: this.userPassword,
                            password_confirmation: this.userPasswordConfirmation,
                            type_user_id: this.typeUserId,
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
        mounted() {
            this.$store.dispatch('getAllTypes');
        },
        beforeDestroy() {
            this.password = '';
            this.passwordConfirmation = '';
        },
    };
</script>