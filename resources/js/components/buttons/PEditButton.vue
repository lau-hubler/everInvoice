<template>
    <a class="btn btn-link text-primary" @click="editItem()">
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
        editItem() {
            EventBus.$emit("edit-item", {
                component: this.component,
                title: this.title,
                props: {
                    id: this.item.id,
                },
            })
        },
    },
};
</script>
