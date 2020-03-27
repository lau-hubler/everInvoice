<template>
    <div>
        <p-update-category
            v-if="editMode"
            :action="action"
            v-model="item"
        ></p-update-category>
        <p-category-details
            v-else
            :id="id"
            :action="action"
        ></p-category-details>
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
        id: Number,
        editMode: null
    },

    data() {
        return {
            item: () => {},
        };
    },

    created() {
        EventBus.$on("edit", this.toggleEditMode);
        EventBus.$on("delete", this.onDelete);

        axios
            .get(this.route(this.id))
            .then((response) => (this.item = response.data));
    },

    methods: {
        toggleEditMode() {
            this.$emit("toggle-edit");
        },
        onDelete() {
            this.$refs["hidden-delete"].click();
        },

        route(id) {
            return `${this.action}/${id}`;
        },
    },
};
</script>
