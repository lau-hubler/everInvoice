<template>
    <b-modal ref="create-modal" :title="title">
        <p>{{ message }}</p>
        <component :is="component" ref="create-form" v-bind="props" :error="error"/>
        <template v-slot:modal-footer>
            <b-button @click="cancel()" variant="secondary">{{ cancelText }}</b-button>
            <b-button @click="submit()" variant="success">{{ okText }}</b-button>
        </template>
    </b-modal>
</template>

<script>
import EventBus from '../eventBus'
export default {
    props: {
        title: {
            type: String,
            default: "Create a new category"
        },
        message: {
            type: String,
            default: "Please select a file to be imported"
        },
        cancelText: {
            type: String,
            default: 'Cancel'
        },
        okText: {
            type: String,
            default: 'Ok'
        },
        error: {
            type: String,
            default: null
        },
        action: {
            type: String
        },
    },
    data() {
        return {
            component: null,
            props: null,
        }
    },

    methods: {
        cancel() {
            this.hide()
        },
        submit() {
            EventBus.$emit('submit-form', { action: this.action})
        },
        show() {
            this.$refs['create-modal'].show()
        },
        hide() {
            this.$refs['create-modal'].hide()
        },
        handleKeyup (e) {
            if (e.keyCode === 27) this.hide()
        }
    },
    mounted() {
        EventBus.$on('create-item', ({ component, props = null }) => {
            this.component = component
            this.props = props
            this.show();
        });
        if (this.error) {
            this.show();
        }
        document.addEventListener('keyup', this.handleKeyup)
    },

    beforeDestroy () {
        document.removeEventListener('keyup', this.handleKeyup)
    },
}
</script>