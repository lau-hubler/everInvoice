<template>
    <a class="btn btn-link text-secondary" @click="showItem()">
        <slot />
    </a>
</template>

<script>
import EventBus from "../../eventBus";
export default {
    props: {
        action: String,
        title: String,
        item: Object,
        component: String,
    },

    methods: {
        show() {
            alert(this.item);
        },
        showItem() {
            EventBus.$emit("show-item", {
                component: this.component,
                title: this.title,
                props: {
                    action: this.action + "/" + this.item.id,
                    item: this.item,
                },
            });
        },
    },
};
</script>
