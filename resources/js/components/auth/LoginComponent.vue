<template>
    <transition name="custom-classes-transition"
                enter-active-class="animated fadeInRightBig"
                leave-active-class="animated fadeOutRightBig">
        <section v-if="showSignForm" class="login-grid-main-sign-in">
            <div class="sign-in-block" :class="animationClass">
                <form action="#"
                      class="sign-in-form"
                      @keydown="LoginForm.errors.clear($event.target.name)"
                      v-on:submit.prevent>
                    <h2>Welcome Back!</h2>
                    <label class="form__label" for="login">Email or Username</label>
                    <input type="text" id="login" :key="0" v-model="LoginForm.login" name="login"
                           @focus="checkLoginFormState()"
                           required>
                    <label class="form__label" for="password">Password</label>
                    <input type="password" v-model="LoginForm.password" id="password" name="password"
                           @focus="checkLoginFormState()" required>
                    <a class="recovery recovery__link" href="#">Forgot your password?</a>
                    <div class="check-box-container">

                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>

                    </div>
                    <button class="sign-in__btn form-register__btn" type="submit"
                            @click="sendForm()" :disabled="loginFormError">Login
                    </button>
                    <div class="recovery">
                        Need an account? <slot><a href="/register" class="recovery__link">Register</a></slot>
                    </div>
                </form>
            </div>
        </section>
    </transition>
</template>

<script>
    import Form from '../../core/Form.js';

    export default {
        name: "Login",
        props: ['showSignForm'],
        computed: {
            animationClass() {
                return this.loginFormError ? 'animated wobble' : ''
            }
        },
        data() {
            return {
                LoginForm: new Form({
                    login: '',
                    password: '',
                }),
                loginFormError: false,
            }
        },
        methods: {
            sendForm() {
                this.LoginForm.submit('post', '/login')
                    .then(response => {
                        window.location.href = response.url;
                    })
                    .catch(error => {
                        this.submitLoginForm();
                    });
            },
            checkLoginFormState() {
                if (this.loginFormError) {
                    this.loginFormError = false;
                }
            },
            submitLoginForm() {
                this.loginFormError = true;

                setTimeout(() => {
                    this.loginFormError = false;
                }, 3000)
            }
        }
    }
</script>

<style scoped>

</style>
