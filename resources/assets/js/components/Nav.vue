<template>
    <nav class="nav has-shadow">
        <div class="container">
            <div class="nav-left">
            <router-link to="/" class="nav-item">
                <img src="/images/logo.svg">
            </router-link>
            </div>
            <div class="nav-right">
                <template v-if="! auth.check()">
                    <span class="nav-item">
                        <router-link to="/" class="button" v-if="$route.path !== '/'" exact>Home</router-link>
                        <router-link to="/login" class="button">Login</router-link>
                        <router-link to="/register" class="button is-primary"><span class="icon"><i class="fa fa-user-plus"></i></span><span>Register</span></router-link>
                    </span>
                </template>
                <template v-else>
                    <span class="nav-item">
                        <div class="button is-disabled" style="border: 0" v-text="auth.user.username"></div>
                        <router-link to="/dashboard" class="button">Dashboard</router-link>
                        <a class="button" @click="logout()">Logout</a>
                    </span>
                </template>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {

        data() {
            return {
                auth: Auth
            }
        },

        methods: {
            logout() {
                axios.get('/api/logout').then((response) => {
                    console.log(response.data);
                    Event.$emit('logout', response.data);
                });
            }
        }
    }
</script>
