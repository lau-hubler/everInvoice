<template>
    <div>
        <p-category-form v-if="editMode"></p-category-form>
        <p-category-details v-else :category="item"></p-category-details>
    </div>
</template>

<script>
import PCategoryDetails from "./PCategoryDetails";
import PCategoryForm from "../forms/PCategoryForm";
import EventBus from "../../eventBus";
import swal from "sweetalert";

export default {
    name: "PCategoryCrud",

    components: { PCategoryDetails, PCategoryForm },

    props: {
        route: String,
        item: {
            type: Object,
            default: {
                name: "",
                description: "",
                iva: "",
            },
        },
    },

    data() {
        return {
            editMode: false,
        };
    },

    created() {
        EventBus.$on("edit", this.toggleEditMode);
        EventBus.$on("save", this.toggleEditMode);
        EventBus.$on("delete", this.onDelete);
    },

    methods: {
        toggleEditMode() {
            this.editMode = !this.editMode;
        },
        onDelete() {
            swal({
                title: `Delete ${this.item.name}?`,
                text: "This can be undone. Are you sure you want to delete it?",
                icon: "warning",
                buttons: ["Cancel", "Delete it"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    this.deleteCategory();
                }
                EventBus.$emit("close-modal");
            });
        },
        deleteCategory() {
            axios.delete(this.route);
            EventBus.$emit("delete-category", this.item);
            swal({
                text: `${this.item.name} has been deleted!`,
                timer: 2000,
            });
        },
    },
};
</script>
