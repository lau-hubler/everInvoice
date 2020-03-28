<template>
    <div>
        <b-button v-if="createMode" @click="create()" variant="success">
            <font-awesome-icon size="xs" icon="save" />
            <span class="pl-1">{{ trans('app.create.modalOkText') }}</span>
        </b-button>

        <span v-if="!createMode">
            <b-button v-if="editMode" @click="save()" variant="success">
                <font-awesome-icon size="xs" icon="save" />
                <span class="pl-1">{{ trans("app.modal.updateText") }}</span>
            </b-button>

            <b-button v-else @click="edit()" variant="primary">
                <font-awesome-icon size="xs" icon="edit" />
                <span class="pl-1">{{ trans("app.modal.editText") }}</span>
            </b-button>

            <p-delete-button :item="item" :action="route(id)">
                <b-button variant="danger">
                    <font-awesome-icon size="xs" icon="trash" />
                    <span class="pl-1">{{ trans("app.modal.deleteText") }}</span>
                </b-button>
            </p-delete-button>
        </span>

        <b-button @click="cancel()" variant="secondary">
            <font-awesome-icon size="xs" icon="times" />
            <span class="pl-1">{{ trans("app.modal.cancelText") }}</span>
        </b-button>
    </div>
</template>

<script>
import EventBus from "../eventBus";

export default {
    props: {
        id: Number,
        item: Object,
        editMode: Boolean,
        createMode: Boolean,
        object: String,
        action: String
    },

    computed: {
        pUpdateObject: function () {
            return "p-update-" + this.object;
        },
    },

    methods: {
        cancel() {
            EventBus.$emit("close-modal");
        },
        create() {
            EventBus.$emit("create")
        },
        deleteItem() {
            EventBus.$emit("delete");
        },
        edit() {
            EventBus.$emit("edit-item", {
                component: this.pUpdateObject,
                title: "Editing",
                object: this.object,
                id: this.id,
            });
        },
        save() {
            EventBus.$emit("save");
        },
        route(id) {
            return `${this.action}/${id}`;
        },
    },
};
</script>
