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
            hasDefault: String,
        },

        methods: {
            onDelete(item) {
                if(item.id === 1 && this.hasDefault != null) {
                    this.cannotDelete(item)
                } else {
                    this.confirmDelete(item)
                }
            },
            deleteCategory(item) {
                axios.delete(this.route(item));
                EventBus.$emit(`delete-${this.type}`, item);
                swal({
                    text: `${item.name} has been deleted!`,
                    timer: 2000,
                });
            },
            confirmDelete(item) {
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
            cannotDelete(item){
                swal({
                    title: `${item.name} a default ${this.type}`,
                    icon: "error",
                    dangerMode: true,
                    text: `Sorry! You cannot delete a default ${this.type}`,
                    timer: 3000,
                });
            },
            route(item) {
                return `${this.action}/${item.id}`;
            },
        }
    }
</script>
