import VueRouter from 'vue-router';

let routes = [

	{
		path: '/',
		component: require('./views/Home.vue'),
		meta: { guest: true }
	},

	{
		path: '/login',
		component: require('./views/Login.vue'),
		meta: { guest: true }
	},

	{
		path: '/register',
		component: require('./views/Register.vue'),
		meta: { guest: true }
	},

	{
		path: '/dashboard',
		component: require('./views/Dashboard.vue'),
		meta: { auth: true }
	},

	{
		path: '/attempt',
		component: require('./views/Attempt.vue'),
		meta: { auth: true }
	},

	{
		path: '/set',
		component: require('./views/Set.vue'),
		meta: { auth: true }
	},

	{
		path: '/statistics',
		component: require('./views/Statistics.vue'),
		meta: { auth: true }
	}

];

let router = new VueRouter({
	routes,
	linkActiveClass: 'is-focused',
});

router.beforeEach((to, from, next) => {

	axios.get('api/user').then(({data}) => {
		Auth.user = data;

		if (data == null) {
			router.push('/login');
		}
	});

	if(to.meta.guest && Auth.check()) {
		return next('/dashboard');
	}

	if(to.meta.auth && ! Auth.check()) {
		return next('/login');
	}

	return next();
});

export default router;
