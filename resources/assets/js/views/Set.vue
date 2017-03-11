<template>
	<div class="section">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card" ref="box">
						<div class="card-content">
						<div class="notification" :class="step == 4 ? 'is-success' : ''" v-text="message"></div>
						<template v-if="step < 3">
							<progress class="progress is-large" :class="style" :value="progress" max="100"></progress>
							<tap-recorder @recorded="register"></tap-recorder>
						</template>
						</div>
						<div class="card-content" v-if="step < 3">
							<a class="button is-default is-fullwidth" @click="restart">Reset</a>
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
				step: 0,
				taps: [],
				name: '',
			}
		},

		methods: {
			register(tap) {
				if (this.addTap(tap)) {
					this.step++;
				}

				if (this.step == 3) {
					this.finish();
				}
			},

			addTap(tap) {
				if (this.taps.length == 0) {
					this.taps.push(tap);

					return true;
				}

				if (tap.length != this.taps[0].length) {
					this.shake();
					return false;
				}

				this.taps.push(tap);

				return true;
			},

			finish() {
				axios.post('/api/master', { sequences: this.taps }).then(() => {
					this.step++;

					setTimeout(() => {
						this.$router.push('/dashboard');
					}, 2000);
				});
			},

			shake() {
				let el = $(this.$refs.box);
				el.addClass('shake');
				setTimeout(() => {
					el.removeClass('shake');
				}, 1000);
			},

			restart() {
				this.step = 0;
				this.taps = [];
				this.name = '';
			}
		},

		computed: {
			progress() {
				return this.taps.length / 3 * 100;
			},

			message() {
				let messages = [
					'Press start to record a master key.',
					'Tap the same sequence two more times.',
					'Just one more time.',
					'Saving tap sequence...',
					'Master key has been saved successfully.',
				];

				return messages[this.step];
			},

			style() {
				if (this.taps.length < 3) {
					return 'is-warning';
				}

				return 'is-success';
			}
		}
	}
</script>
