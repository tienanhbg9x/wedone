<template>
    <div class="container">
        <div class="card o-hidden border-primary shadow-lg my-5">
            <div class="card-body p-0 ">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng kí tài khoản</h1>
                            </div>
                            <div class="alert alert-danger" v-if="error">
                                <p>Đăng kí thất bại, Email đã tồn tại hoặc không hợp lệ</p>
                            </div>
                            <div class="alert alert-success" v-if="success">
                                <p>Đăng kí thành công, vui lòng kiểm tra email</p>
                            </div>
                            <form class="user" v-on:submit.prevent="register" autocomplete="on">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input v-model="name" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" v-model="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password" v-model="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <router-link to="/password" class="small">Forgot Password?</router-link>
                            </div>
                            <div class="text-center">
                                <router-link to="/login" class="small">Already have an account? Login!</router-link>
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
        name: "register",
        data() {
            return {
                name: '',
                email: '',
                password: '',
                error:false,
                success:false,
            };
        },
        methods: {
            register() {
                this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                    .then(response => {
                        this.success = true;
                        setTimeout(function () {
                            this.$router.push({ path: '/login'})}.bind(this), 5000);
                    })
                    .catch(error => {
                        this.error = true;
                        setTimeout(function () {
                            this.error = false
                        }.bind(this),3000)
                    })
            }

        },
    }

</script>