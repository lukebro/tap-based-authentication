<template>
	<div class="section">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card">
						<div class="card-content">
							<div v-if="message" class="notification has-text-centered" :class="style"><div class="title">{{ message }}</div></div>
							<p v-else class="notification">Attempt to authenticate using your master key.</p>
							<tap-recorder v-on:recorded="validate" v-on:start="reset"></tap-recorder>
						</div>
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
				style: '',
				message: ''
			}
		},

		methods: {
			validate(sequence) {
				axios.post('/api/attempt', { sequence }).then(response => {
					if (response.data === 'SUCCESS') {
						this.style = 'is-success';
						this.message = 'ACCEPTED';
						return;
					}

					this.style = 'is-danger';
					this.message = 'REJECTED';
				});
			},

			reset() {
				this.message = '';
			}
		}
	}
</script>
