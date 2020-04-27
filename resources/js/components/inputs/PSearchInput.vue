<template>
    <b-form-tags
        input-id="tags-basic"
        v-model="filter"
        tag-pills
        tag-variant="primary"
        :size="size"
        separator=" "
        remove-on-delete
        no-add-on-enter
        placeholder="Search..."
        @input="sendFilter"
    />
</template>

<script>
import EventBus from "../../eventBus";

export default {
    name: "PSearchInput.vue",

    props: {
        size: { default: "lg" },
        item: null,
    },
    data() {
        return {
            filter: [],
        };
    },

    methods: {
        sendFilter() {
            EventBus.$emit(`search-${this.item}`, this.filter);
        },
    },
};
</script>

<style scoped></style>
