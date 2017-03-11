<template>
	<div class="section">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card">

							<div class="card-content">
								Statistics are based on all your attempts.
							</div>
							<table class="table" v-if="statistics.total != 0">
								<tr><th>Total Attempts</th><td>{{ statistics.total }}</td></tr>
								<tr><th>Accepted</th><td>{{ statistics.accepted }}</td></tr>
								<tr><th>Rejected</th><td>{{ statistics.rejected }}</td></tr>
								<tr><th>False Rejection Rate</th><td>{{ statistics.frr }}%</td></tr>
							</table>
							<div class="card-content" v-else>
								<div class="notification is-danger">
									You haven't attempted any pass keys.  Create a master key and attempt to pass the authentication.
								</div>
							</div>

							<div class="card-content" v-if="reset.includes(auth.user.username)">
								<a class="button is-default is-fullwidth" @click="resetStatistics">Reset Statistics</a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mounted() {
			axios.get('/api/statistics').then(({data}) => {
				this.statistics = data
			});
		},

		data() {
			return {
				statistics: {},
				auth: Auth,
				reset: ['admin', 'sigcse2017']
			}
		},

		methods: {
			resetStatistics() {
				axios.delete('/api/statistics/reset').then(() => {
					this.$router.push('/dashboard');
				});
			}
		}
	}
</script>
