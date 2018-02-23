<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ User.name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div v-if="progress" class="loading"></div>
                        <div class="col-md-12">
                            <form class="form-horizontal" @submit.prevent="putUser">
                                <div :class="{ 'form-group': true, 'has-error': errors.has('name') }">
                                    <label for="name" class="control-label">{{ $t("translation.name") }}</label>
                                    <input id="name" type="text" class="form-control" name="name"  v-model="User.name" v-validate="'required|max:255'" autofocus>
                                    <span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
                                </div>
                                <div :class="{ 'form-group': true, 'has-error': errors.has('email') }">
                                    <label for="email" class="control-label">{{ $t("translation.email") }}</label>
                                    <input id="email" type="email" class="form-control" name="email"  v-model="User.email" v-validate="'required|email|max:255'" @input="$validator.validate('email', 1)">
                                    <!--  -->
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
                                        {{ $t("translation.typeUser") }}
                                    </label>
                                    <select id="type_user" class="form-control" name="type_user" v-model="typeUser" v-validate="'required'" >
                                        <option :value="type.id" v-for="type in AllTypes">{{ type.type }}</option>
                                    </select>
                                    <span v-show="errors.has('type_user')" class="help-block">{{ errors.first('type_user') }}</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="login-btn btn btn-success" :disabled="this.progress">
                                        {{ $t("translation.save") }}
                                    </button>
                                    <button type="button" class="login-btn btn btn-danger" @click='deleteUser' :disabled="this.progress">
                                        {{ $t("translation.delete") }}
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
                typeUser: 1,
                showModal: false,
            };
        },
       
        methods: {
            async putUser() {
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    this.progress = true;

                    try {
                        await this.$store.dispatch('putUser', {
                            data: {
                                user_id: this.$route.params.userId,
                                name: this.User.name,
                                email: this.User.email,
                                type_user_id: this.typeUser,
                                password: this.userPassword,
                                password_confirmation: this.userPasswordConfirmation,
                                type_user_id: this.typeUser,
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

            async deleteUser() {
                    this.$swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (!result.value) {
                    try{
                        this.$store.dispatch('deleteUser', {
                                data: {
                                    user_id: this.$route.params.userId,
                                }                        
                        });
                    } catch(e){
                        this.$swal(
                        'Error!',
                        'User hasn`t been deleted.',
                        'error'
                    )
                  }

                  this.$swal(
                        'Success!',
                        'User has been deleted.',
                        'success'
                    ).then(()=>{
                        this.$router.push({
                            name: 'user.all',
                        });
                    })                  
                } 
                })  
                            
                      
                },
        },
         mounted() {
            this.$store.dispatch('getAllTypes');
            this.$store.dispatch('getUser', {
                data: {
                    user_id: this.$route.params.userId,
                }
            });        
        },
        
        created() {
            //this.$validator.attach('email', 'unique');
        },
        beforeDestroy() {
            this.password = '';
            this.passwordConfirmation = '';
        },
    };
</script>
