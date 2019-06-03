<template>
    <div class="register-grid">
        <transition name="custom-classes-transition"
                    enter-active-class="animated fadeInLeftBig"
                    leave-active-class="animated fadeOutLeftBig">

            <section v-if="!showSignForm" class="register-form-pos">
                <form method="POST"
                      action="/register"
                      class="register-form"
                      @keydown="form.errors.clear($event.target.name)"
                      v-on:submit.prevent>
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <h2>Create your account</h2>
                    <div class="register-form-block-fields">
                        <label for="login" class="register-form-block-fields__label">Username</label>
                        <input id="login"
                               type="text"
                               name="login"
                               required
                               minlength="3"
                               v-model="form.login"
                               :class="{'input-error' : loginNotAvailable}"
                               @blur="isLoginAvailable"
                        >
                        <span class="error-help__text" v-if="form.errors.has('login')"
                              v-text="form.errors.get('login')"></span>
                    </div>
                    <div class="register-form-block-fields">
                        <label for="email" class="register-form-block-fields__label">Email</label>
                        <input id="email"
                               type="email"
                               name="email"
                               required
                               v-model="form.email"
                               @blur="isEmailNotAvailable"
                               :class="{'input-error' : emailNotAvailable}"
                        >
                        <span class="error-help__text" v-if="form.errors.has('email')"
                              v-text="form.errors.get('email')"></span>
                    </div>
                    <div class="register-form-block-fields">
                        <label for="password" class="register-form-block-fields__label">Password</label>

                        <input id="password"
                               type="password"
                               required
                               minlength="8"
                               class="register-form-block-fields__password"
                               v-model="form.password"
                               :class="{'input-error' : passHasError}"
                               @blur="validatePass"
                        >
                        <span class="password-eye" @click="togglePasswordVision">
                            <i class="fas" :class="passwordVision"></i>
                        </span>

                        <span class="error-help__text error-help__pass" v-if="form.errors.has('password')"
                              v-text="form.errors.get('password')"></span>

                    </div>
                    <button type="submit" class="register-form__btn_submit" @click="sendForm"
                            :disabled="checkForErrors || form.errors.any()">Create new account
                    </button>
                    <div class="register-form-footer">
                        <a href="#" class="register-form-footer__link"
                           @click.prevent="changeSignForm()">Already have an account?</a>
                        <span class="register-form-footer-span">By registering, you agree to our <a href="#">Terms of service</a> and <a
                            href="#">Privacy Policy</a>
                        </span>
                    </div>
                </form>
            </section>
        </transition>
        <transition name="custom-classes-transition"
                    enter-active-class="animated fadeInLeftBig"
                    leave-active-class="animated fadeOutLeftBig">
            <section v-if="!showSignForm" class="header-logo-pos">
                <div class="header-logo">
                    <a href="/">
                        <span class="header-logo__baikal">Baikal </span>
                        <span class="header-logo__magazine">Magazine</span>
                    </a>
                </div>
            </section>
        </transition>

        <login-component :show-sign-form="showSignForm">
            <a href="#" @click.prevent="showSignForm = false" class="recovery__link">Register</a>
        </login-component>
    </div>
</template>
<style scoped>
    .header-logo__magazine {
        color: #b70000 !important;
        background: #222325 !important;
    }

    .header-logo__baikal {
        background: #222325 !important;
    }

    .login-grid-main-sign-in {
        position: absolute;
        top: 0vh;
        left: 23vw;
    }
</style>
<script>
    import Form from '../../core/Form.js';

    export default {
        name: "RegistrationComponent",
        props: ['csrf'],
        data() {
            return {
                form: new Form({
                    login: '',
                    email: '',
                    password: '',
                }),
                passHasError: false,
                emailNotAvailable: false,
                loginNotAvailable: false,
                formHasErrors: false,
                showSignForm: false,
                passShown: false,
            }
        },
        methods: {
            sendForm() {
                this.form.submit('post', '/register')
                    .then(response => {
                        window.location.href = response.url;
                    });
            },
            changeSignForm() {
                this.showSignForm = !this.showSignForm;
            },
            validatePass() {
                this.passMessengeCheck();
                this.passHasError = false;
                this.passConfirmHasError = false;
                this.checkTypedPassword();
            },
            passMessengeCheck() {
                if (!this.passHasError) {
                    this.form.errors.clear('password')
                }
            },
            checkTypedPassword() {
                let password = this.form.password;

                if (password.length < 8) {
                    this.passHasError = true;
                    this.form.errors.record({
                        'password': ["The password must be at least 8 symbols."]
                    });
                }

                if (password.length >= 8) {
                    this.passMessengeCheck();
                }
            },

            isEmailNotAvailable() {
                let email = this.form.email;

                this.checkEmailInput(email);

                if (this.isValidEmail(email)) {
                    axios.post('/register/email', {'email': email})
                        .then(response => {
                            this.emailNotAvailable = response.data;
                            if (response.data) {
                                this.form.errors.record({
                                    'email': ['This email is already in use']
                                })
                            }
                        })
                }
            },
            isValidEmail(email) {
                let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return regex.test(email);
            },
            checkEmailInput(email) {
                if (this.form.errors.has('email') || !this.isValidEmail(email) && email.length > 0) {
                    this.form.errors.record({
                        'email': ['The email must be a valid email address.']
                    });
                    return this.emailNotAvailable = true;
                }
                return this.emailNotAvailable = false;
            },
            isLoginAvailable() {
                let login = this.form.login;
                this.loginNotAvailable = false;
                if (login.length >= 3) {
                    axios.post('/register/login', {'login': login})
                        .then(response => {
                            this.loginNotAvailable = response.data;
                            if (response.data) {
                                this.form.errors.record({
                                    'login': ['This login is already in use']
                                })
                            }
                        })
                }
                if (login.length < 3) {
                    this.form.errors.record({
                        'login': ['The login must be at least 3 characters.']
                    });
                }
            },
            togglePasswordVision() {
                let passField = document.getElementById('password');
                switch (passField.type) {
                    case 'password':
                        passField.type = 'text';
                        this.passShown = true;
                        break;
                    case 'text':
                        passField.type = 'password';
                        this.passShown = false;
                        break;
                }
            }
        },
        computed: {
            checkForErrors() {
                if (this.passHasError ||
                    this.emailNotAvailable ||
                    this.loginNotAvailable) {
                    return this.formHasErrors = true;
                }
                return this.formHasErrors = false;
            },
            passwordVision() {
              return this.passShown ? 'fa-eye-slash' : 'fa-eye';
            }

        }
    }
</script>
