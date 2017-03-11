<template>
	<div class="section">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card">
						<div class="card-content" v-if="! (auth.user.hasMasterKey && auth.user.hasAttempt)">
							<span v-if="! auth.user.hasMasterKey">Before you can do anything, you need to create a master key.</span>
							<span v-if="auth.user.hasMasterKey && ! auth.user.hasAttempt">Attempt to authenticate now using your master key.</span>
						</div>
						<div class="card-content">
							<p class="control" v-if="auth.user.hasMasterKey">
								<router-link to="/attempt" class="button is-large is-primary is-fullwidth">Attempt Authentication</router-link>
							</p>
							<p class="control">
								<router-link to="/set" class="button is-large is-danger is-fullwidth">Set Master Key</router-link>
							</p>
							<p class="control" v-if="auth.user.hasAttempt">
								<router-link to="/statistics" class="button is-large is-warning is-fullwidth">Statistics</router-link>
							</p>
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
				auth: Auth
			}
		}
	}
</script>
