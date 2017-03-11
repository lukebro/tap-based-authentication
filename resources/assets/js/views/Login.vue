<template>
	<div class="section">
		<div class="container">
			<div class="columns is-vcentered">
				<div class="column is-4 is-offset-4">
				<div class="card">
					<div class="card-header">
						<span class="card-header-title">Login</span>
					</div>
					<form @submit.prevent="onSubmit" class="card-content">
						<div v-show="form.errors.any()" class="notification is-danger">
							{{ form.errors.errors['username'] }}
						</div>
						<label class="label">Username</label>
						<p class="control">
						  <input class="input is-medium" type="text" placeholder="Username" name="username" v-model="form.username" autocomplete="off" autocapitalize="off" required>
						</p>
						<label class="label">Password</label>
						<p class="control">
						  <input class="input is-medium" type="password" placeholder="Password" name="password" v-model="form.password" required>
						</p>
						<p class="control">
							<button type="submit" class="button is-primary is-medium">Login</button>
						</p>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				form: new Form({ username: '', password: '', remember: true})
			}
		},

		methods: {
			onSubmit() {
				this.form.errors.clear();
				this.form.post('/api/login').then(user => {
					Event.$emit('login', user);
				}).catch(error => {
					if (error.user) {
						Event.$emit('login', error.user);
					}
				});
			}
		}
	}
</script>
