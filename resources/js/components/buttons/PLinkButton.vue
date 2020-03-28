<template>
    <b-link class="btn btn-link" :class="variant" @click="editItem()">
        <slot />
    </b-link>
</template>

<script>
import EventBus from "../../eventBus";
export default {
    props: {
        id: Number,
        component: String,
        event: String,
        variant: {
            type: String,
            default: "text-secondary",
        },
    },

    methods: {
        editItem() {
            EventBus.$emit(this.event, {
                component: this.component,
                id: this.id,
            });
        },
    },
};
</script>
