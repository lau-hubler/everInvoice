<template>
    <div>
        <b-button v-if="editMode" @click="save()" variant="success">
            <font-awesome-icon size="xs" icon="save" />
            <span class="pl-1">{{ trans("app.modal.updateText") }}</span>
        </b-button>

        <b-button v-else @click="edit()" variant="primary">
            <font-awesome-icon size="xs" icon="edit" />
            <span class="pl-1">{{ trans("app.modal.editText") }}</span>
        </b-button>

        <b-button @click="deleteItem()" variant="danger" class="mx-1">
            <font-awesome-icon size="xs" icon="trash" />
            <span class="pl-1">{{ trans("app.modal.deleteText") }}</span>
        </b-button>

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
        editMode: Boolean,
        object: String,
    },

    computed: {
        pUpdateObject: function () {
            return 'p-update-'+ this.object
        },
    },

    methods: {
        cancel() {
            EventBus.$emit("close-modal");
        },
        deleteItem() {
            EventBus.$emit("delete");
        },
        edit() {
            EventBus.$emit("edit-item", {
                component: this.pUpdateObject,
                title: "Editing",
                object: this.object,
                id: this.id
            });
        },
        save() {
            EventBus.$emit("save");
        },

        toggleEditMode() {
            this.editMode = this.$emit("toggle-edit");
        },
    },
};
</script>
