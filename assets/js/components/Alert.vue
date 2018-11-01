<template>
    <b-alert :show="dismissCountDown"
             dismissible
             :variant="type"
             @dismissed="dismissCountDown=0"
             @dismiss-count-down="countDownChanged">
        <slot></slot>
    </b-alert>
</template>

<script>
    export default {
        props: ['type', 'time'],
        data () {
            return {
                dismissSecs: this.time,
                dismissCountDown: 0,
                showDismissibleAlert: false
            }
        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert () {
                this.dismissCountDown = this.dismissSecs
            }
        },
        mounted() {
            this.showAlert()
        }
    }
</script>