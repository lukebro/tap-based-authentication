<template>
    <div>
        <div class="notification is-info tap-recorder" ref="tap">Tap Here</div>
        <a type="button" class="button is-large is-fullwidth" :class="{ 'is-success' : ! recording, 'is-danger' : recording}" @click="toggle">{{ ! recording ? 'Start Listening' : 'Stop' }}</a>
    </div>
</template>

<script>

    export default {
        mounted() {
            this.hammer = new Hammer.Manager(this.$refs.tap);
            this.hammer.add(new Hammer.Tap({ event: 'hit', taps: 1, interval: 6000, time: 6000}));

            this.hammer.on('hammer.input', (ev) => {
                if (! this.recording) {
                    return;
                }

                if (ev.isFirst) {
                    this.taps.push(ev.timeStamp);
                    return
                }

                    if (ev.isFinal ) {
                        this.taps.push(ev.timeStamp);
                        return
                    }
            });
        },

        data() {
            return {
                hammer: null,
                recording: false,
                taps: []
            }
        },

        methods: {
            toggle() {
                if (this.recording) {
                    if (this.taps.length) {
                        this.$emit('recorded', this.taps);
                    }
                    this.$emit('stop');
                    this.reset();
                } else {
                    this.$emit('start');
                }

                this.recording = ! this.recording;
            },

            reset() {
                this.taps = [];
            }
        }
    }
</script>
