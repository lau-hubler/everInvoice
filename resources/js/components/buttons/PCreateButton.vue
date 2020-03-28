<template>
    <b-button variant="primary" class="font-weight-bold" @click="createItem()">
        <slot />
    </b-button>
</template>

<script>
import EventBus from "../../eventBus";

export default {
    props: {
        component: String,
    },

    methods: {
        createItem() {
            EventBus.$emit("create-item", {
                component: this.component,
            });
        },
    },
};
</script>
