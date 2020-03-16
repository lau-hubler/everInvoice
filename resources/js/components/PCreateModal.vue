<template>
    <b-modal ref="create-modal" :title="title">
        <p>{{ message }}</p>
        <b-form ref="create-form" :action="action" method="POST">
            <input :value="CSRFToken" type="hidden" name="_token">
            <component :is="component" v-bind="props" :error="error" :dfields="dataFields"/>
        </b-form>
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
            CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
        }
    },

    methods: {
        cancel() {
            this.hide();
        },
        submit() {
            this.hide();
            this.$refs['create-form'].submit();
        },
        show() {
            this.$refs['create-modal'].show()
        },
        hide() {
            this.$refs['create-modal'].hide();
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