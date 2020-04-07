<template>
    <b-form-tags
        input-id="tags-basic"
        v-model="filter"
        tag-pills
        tag-variant="primary"
        size="lg"
        placeholder="Search..."
        @input="sendFilter"
    />
</template>

<script>
    import EventBus from "../../eventBus";

    export default {
        name: "PSearchInput.vue",

        data() {
            return {
                filter: [],
            }
        },

        methods: {
            sendFilter(){
                EventBus.$emit('search', this.filter )
            }
        }
    }
</script>

<style scoped>

</style>
