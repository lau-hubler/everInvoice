<template>
    <a class="btn btn-link text-danger" @click="onDelete(item)">
        <slot />
    </a>
</template>

<script>
    import swal from "sweetalert";
    import EventBus from "../../eventBus";
    import _ from "lodash";

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
                    text: `${item.name} ${_.get(window.i18n, 'app.messages.deleted')}`,
                    timer: 2000,
                });
            },
            confirmDelete(item) {
                swal({
                    title: _.get(window.i18n, 'app.titles.delete'),
                    text: _.get(window.i18n, 'app.messages.delete'),
                    icon: "warning",
                    buttons: [
                        _.get(window.i18n, 'app.buttons.cancel'),
                        _.get(window.i18n, 'app.buttons.delete')
                    ],
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
                    title: `${item.name} ${_.get(window.i18n, 'app.titles.cannotDelete')}`,
                    icon: "error",
                    dangerMode: true,
                    text: _.get(window.i18n, 'app.messages.cannotDelete'),
                    timer: 3000,
                });
            },
            route(item) {
                return `${this.action}/${item.id}`;
            },
        }
    }
</script>
