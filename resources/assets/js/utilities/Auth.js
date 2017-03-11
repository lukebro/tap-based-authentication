class Auth {

	constructor(user) {
		this.user = user ? user : null;
	}

	login(user) {
		this.user = user;
	}

	check() {
		return this.user ? true : false;
	}

	user() {
		return this.user;
	}

	logout() {
		this.user = null;
	}

}

export default Auth;