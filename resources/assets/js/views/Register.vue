<template>
	<div class="section">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card">
					<div class="card-header">
						<span class="card-header-title">Register</span>
					</div>
					<form @submit.prevent="onSubmit" class="card-content">
						<div v-show="form.errors.any()" class="notification is-danger">
							<div>{{ form.errors.get('username') }}</div>
							<div>{{ form.errors.get('password') }}</div>
						</div>
						<label class="label">Username</label>
						<p class="control">
						  <input class="input is-medium" type="text" placeholder="Username" name="username" v-model="form.username" autocomplete="off" autocapitalize="off" required>
						</p>
						<label class="label">Password</label>
						<p class="control">
						  <input class="input is-medium" type="password" placeholder="Password" name="password" v-model="form.password" required>
						</p>
						<label class="label">Retype Password</label>
						<p class="control">
						  <input class="input is-medium" type="password" placeholder="Password" name="password" v-model="form.password_confirmation" required>
						</p>
						<p class="control">
							<button type="submit" class="button is-primary is-medium">Register</button>
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
				form: new Form({ username: '', password: '', password_confirmation: ''})
			}
		},

		methods: {
			onSubmit() {
				this.form.errors.clear();
				this.form.post('/api/register').then(user => {
					Event.$emit('login', user);
				});
			}
		}
	}
</script>
