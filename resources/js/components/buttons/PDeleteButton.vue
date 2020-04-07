<template>
    <a class="btn btn-link text-danger" @click="onDelete(item)">
        <slot />
    </a>
</template>

<script>
import swal from "sweetalert";
import EventBus from "../../eventBus";
import _ from "lodash";
import api from "../../api";

export default {
    name: "PDeleteButton",
    props: {
        type: String,
        item: null,
        name: String,
        hasDefault: String,
        close: { type: null, default: true },
    },

    methods: {
        onDelete(item) {
            if (item.id === 1 && this.hasDefault != null) {
                this.cannotDelete(item);
            } else {
                this.confirmDelete(item);
            }
        },
        deleteItem(item) {
            api.deleteItem(this.type, item)
                .then(EventBus.$emit(`delete-${this.type}`, item))
                .then(
                    swal({
                        text: `${this.itemDeletedName(item)} ${_.get(
                            window.i18n,
                            "app.messages.deleted"
                        )}`,
                    })
                );
        },
        confirmDelete(item) {
            swal({
                title: _.get(window.i18n, "app.titles.delete"),
                text: _.get(window.i18n, "app.messages.delete"),
                icon: "warning",
                buttons: [
                    _.get(window.i18n, "app.buttons.cancel"),
                    _.get(window.i18n, "app.buttons.delete"),
                ],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    this.deleteItem(item);
                }
                if (this.close == true) {
                    EventBus.$emit("close-modal");
                }
            });
        },
        cannotDelete(item) {
            swal({
                title: `${this.itemDeletedName(item)} ${_.get(
                    window.i18n,
                    "app.titles.cannotDelete"
                )}`,
                icon: "error",
                dangerMode: true,
                text: _.get(window.i18n, "app.messages.cannotDelete"),
                timer: 3000,
            });
        },
        itemDeletedName(item) {
            if (this.name) {
                return this.name;
            } else {
                return item.name;
            }
        },
    },
};
</script>
