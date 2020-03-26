<template>
    <div>
        <p-update-category v-if="editMode" :action="action" v-model="item"></p-update-category>
        <p-category-details v-else :id="id" :action="action"></p-category-details>
        <p-delete-button :action="action" :item="item">
            <button hidden ref="hidden-delete" />
        </p-delete-button>
    </div>
</template>

<script>
import PCategoryDetails from "./PCategoryDetails";
import PUpdateCategory from "./PUpdateCategory";
import PDeleteButton from "../buttons/PDeleteButton";
import EventBus from "../../eventBus";

export default {
    name: "PCategoryCrud",

    components: { PCategoryDetails, PUpdateCategory, PDeleteButton },

    props: {
        action: String,
        id: Number
    },

    data() {
        return {
            editMode: false,
            item: () => {}
        };
    },

    created() {
        EventBus.$on("edit", this.toggleEditMode);
        EventBus.$on("update-category", this.toggleEditMode);
        EventBus.$on("delete", this.onDelete);

        axios.get(`/categories/${this.id}`).then((response) => this.item = response.data)
    },

    methods: {
        toggleEditMode() {
            this.editMode = !this.editMode;
        },
        onDelete() {
            this.$refs["hidden-delete"].click();
        },
    },
};
</script>
