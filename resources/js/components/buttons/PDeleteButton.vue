<template>
    <a class="btn btn-link text-danger" @click="onDelete(item)">
        <slot />
    </a>
</template>

<script>
    import swal from "sweetalert";
    import EventBus from "../../eventBus";

    export default {
        name: "PDeleteButton",
        props: {
            type: String,
            action: String,
            item: null,
        },

        methods: {
            onDelete(item) {
                swal({
                    title: `Delete ${item.name}?`,
                    text: "This can be undone. Are you sure you want to delete it?",
                    icon: "warning",
                    buttons: ["Cancel", "Delete it"],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.deleteCategory(item);
                    }
                    EventBus.$emit("close-modal");
                });
            },
            deleteCategory(item) {
                axios.delete(this.route(item));
                EventBus.$emit(`delete-${this.type}`, item);
                swal({
                    text: `${item.name} has been deleted!`,
                    timer: 2000,
                });
            },
            route(item) {
                return `${this.action}/${item.id}`;
            },
        }
    }
</script>
