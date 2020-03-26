<template>
    <b-button variant="primary" @click="createItem(action)">
        <slot />
    </b-button>
</template>

<script>
import EventBus from "../../eventBus";

export default {
    props: {
        action: {
            type: String,
        },
        component: String,
    },

    methods: {
        createItem(action) {
            EventBus.$emit("create-item", {
                component: this.component,
                props: { action },
            });
        },
    },
};
</script>
