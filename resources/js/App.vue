<template>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item" v-if="user">
                    <span class="nav-link pointer">{{ user.name }}</span>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link">Projects</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/parameters" class="nav-link">Parameters</router-link>
                </li>
                <li class="nav-item" v-if="user">
                    <span class="nav-link pointer" v-on:click="logout">Logout</span>
                </li>
                <li class="nav-item" v-else>
                    <a v-google-oauth="client_id" class="nav-link pointer">SigIn with Google</a>
                </li>
            </ul>
        </nav>
        <br/>
        <div class="container-fluid">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
        <notifications group="app" position="bottom left" :speed="500"></notifications>
    </div>
</template>

<script>
    import googleOauth from 'google-oauth-vue-directive'

    export default {
        name: "App",

        directives: {
            googleOauth
        },

        data() {
            return {
                user: null,
                client_id: null,
            }
        },

        created() {
            this.client_id = document.getElementsByName('google-client-id')[0].getAttribute('value');

            this.axios.get('/api/user').then(response => {
                this.user = response.data;
            });
        },

        methods: {
            onGoogleAuthSuccess(googleAuth) {
                googleAuth.signIn()
                    .then(user => {
                        return this.axios.post('/api/auth', {
                            token: user.Zi.access_token
                        });
                    })
                    .then(response => {
                        this.user = response.data;
                        this.$notify({
                            group: 'app',
                            type: 'success',
                            title: 'Auth',
                            text: 'Logged successful.'
                        });
                    })
                    .catch(err => {
                        this.$notify({
                            group: 'app',
                            type: 'error',
                            title: 'Auth',
                            text: err.toString()
                        });
                        console.warn();
                    });
            },
            onGoogleAuthError(err) {
                console.warn(':oauth-error:', error)
                // you can do stuff here with the received error.
            },
            logout() {
                this.axios.post('/api/logout').then(() => {
                    this.user = null;
                    this.$notify({
                        group: 'app',
                        type: 'success',
                        title: 'Logout',
                        text: 'Logout successful.'
                    });
                });
            },
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter, .fade-leave-active {
        opacity: 0;
    }

    .pointer {
        cursor: pointer;
    }
</style>
