<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-10 shadow-lg my-5 border-primary">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                                    </div>
                                    <div class="alert alert-danger" v-if="error">
                                        <p>Email hoặc mật khẩu không đúng, vui lòng đăng nhập lại</p>
                                    </div>
                                    <form class="user"  v-on:submit.prevent="login" autocomplete="on" >
                                        <div class="form-group">
                                            <input v-model="email" type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"  placeholder="Enter Email Address..." >
                                        </div>
                                        <div class="form-group">
                                            <input v-model="password" type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" >
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <router-link to="/password" class="small">Forgot Password?</router-link>
                                    </div>
                                    <div class="text-center">
                                        <router-link to="/register" class="small">Create an Account!</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        name: "Login.vue",
        data(){
            return {
                email: '',
                password: '',
                error: false,
            }
        },

        methods: {
            login() {
                this.$store.dispatch('retrieveToken', {
                    email: this.email,
                    password: this.password
                })
                    .then(response => {
                        this.$router.push({ path: '/'})
                    })
                    .catch(error => {
                        this.error = true;
                        setTimeout(function () {
                            this.error = false;
                        }.bind(this),3000)
                    })
            },
        },
    }
</script>
<style scoped>

</style>
