<template>
    <b-button :variant="variant" :size="size" @click="createItem(action)">
        <slot/>
    </b-button>
</template>

<script>
import EventBus from '../../eventBus'
    export default {
        props: {
            action: {
                type: String
            },
            variant: {
                type: String,
                default: "primary"
            },
            size: {
                type: String,
                default: "md"
            },
            component: String
        },
        methods: {
            createItem(action) {
                EventBus.$emit('create-item', {
                  component: this.component,  
                  props: { action }
                });
            },
        }
    }
</script>