import './bootstrap';
import router from  './routes';

Vue.component('AppNav', require('./components/Nav.vue'));
Vue.component('TapRecorder', require('./components/TapRecorder.vue'));

const Event = new Vue({});

window.Event = Event;

const app = new Vue({
    el: '#app',
    router,

    mounted() {
    	Event.$on('login', user => {
    		this.auth.login(user);
			this.$router.push('/dashboard');
    	});

        Event.$on('logout', (laravel) => {
            Auth.logout();
            Laravel = laravel;

            axios.defaults.headers.common = {
                'X-CSRF-TOKEN': Laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            };

            this.$router.push('/');
        });
    },

    data: {
    	auth: Auth,
        style: Style,
    }
});

new Hammer(document.getElementById('app'));