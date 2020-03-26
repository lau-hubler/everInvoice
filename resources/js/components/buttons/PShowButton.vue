<template>
    <a class="btn btn-link text-secondary" @click="showItem()">
        <slot />
    </a>
</template>

<script>
import EventBus from "../../eventBus";
export default {
    props: {
        title: String,
        item: Object,
        component: String,
    },

    methods: {
        showItem() {
            EventBus.$emit("show-item", {
                component: this.component,
                title: this.title,
                props: {
                    id: this.item.id,
                },
            });
        },
    },
};
</script>
