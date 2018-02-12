<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                            <form class="form-horizontal" @submit.prevent="getUser">
                                <label for="name" class="control-label">{{ $t("translation.UserId") }}</label>
                                <input type="text" class="form-control" v-model="user_id"/>
                                <button type="submit" class="login-btn btn btn-success" :disabled="this.progress">
                                        {{ $t("translation.take") }}
                                </button>
                            </form>
                            <pre>{{user}}</pre>
             </div>               
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $t("translation.user") }}</h3>
                    </div>
                    <div class="panel-body">
                        <div v-if="progress" class="loading"></div>
                        
                        <div class="col-md-12">
                            <form class="form-horizontal" @submit.prevent="register">
                                <div :class="{ 'form-group': true, 'has-error': errors.has('name') }">
                                    <label for="name" class="control-label">{{ $t("translation.name") }}</label>
                                    <input id="name" type="text" class="form-control" name="name" v-model="name" v-validate="'required|max:255'" autofocus>
                                    <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('email') }">
                                    <label for="email" class="control-label">{{ $t("translation.email") }}</label>
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" v-validate="'required|email|max:255'" @input="$validator.validate('email', 1)">
                                    <span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('password') }">
                                    <label for="password" class="control-label">{{ $t("translation.password") }}</label>
                                    <input id="password" type="password" class="form-control" name="password" v-model="password" v-validate="'required|min:6'">
                                    <span v-show="errors.has('password')" class="help-block">{{ errors.first('password') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('passwordConfirmation') }">
                                    <label for="password-confirmation" class="control-label">{{ $t("translation.confirmPassword") }}</label>
                                    <input id="password-confirmation" type="password" class="form-control" name="passwordConfirmation" v-model="passwordConfirmation" v-validate="'required|confirmed:password'">
                                    <span v-show="errors.has('passwordConfirmation')" class="help-block">{{ errors.first('passwordConfirmation') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('passwordConfirmation') }">
                                    <label for="type_user_id" class="control-label">{{ $t("translation.typeUserId") }}</label>
                                    <input id="type_user_id" type="text" class="form-control" name="typeUserId" v-model="typeUserId" v-validate="'required'">
                                    <!-- <span v-show="errors.has('typeUserId')" class="help-block">{{ errors.first('passwordConfirmation') }}</span> -->
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
        methods: {
            async getUser() {
                await this.$store.dispatch('getUser', {
                    user_id: this.user_id,
                });

            },
            async putUser() {
                await this.$store.dispatch('putUser', {
                    user_id: this.user_id,
                });
            },
            async setUser() {
                await this.$store.dispatch('setUser', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation,
                });
            },
            async deletetUser() {
                await this.$store.dispatch('deleteUser', {
                    user_id: this.user_id,
                });
            },
            /*async register() {
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    this.progress = true;

                    try {
                        await this.$store.dispatch('register', {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.passwordConfirmation,
                        });

                        this.$router.push({
                            name: 'user.all',
                        });
                    } catch (e) {
                        this.$validator.validate('email', 0);

                        this.progress = false;
                    }
                }
            },*/
        },
        computed:{
            user () {
                return this.$store.getters.getUser;
            }
        },
        data() {
            return {
                progress: false,
                user_id: '',
            };
        },
        beforeDestroy() {
            this.password = '';
            this.passwordConfirmation = '';
        },
    };
</script>
