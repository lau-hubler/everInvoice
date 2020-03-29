<template>
    <div>
        <b-button v-if="createMode" @click="create()" variant="success">
            <font-awesome-icon size="xs" icon="save" />
            <span class="pl-1">{{ trans('app.buttons.create') }}</span>
        </b-button>

        <span v-if="!createMode">
            <b-button v-if="editMode" @click="save()" variant="success">
                <font-awesome-icon size="xs" icon="save" />
                <span class="pl-1">{{ trans("app.buttons.update") }}</span>
            </b-button>

            <b-button v-else @click="edit()" variant="primary">
                <font-awesome-icon size="xs" icon="edit" />
                <span class="pl-1">{{ trans("app.buttons.edit") }}</span>
            </b-button>

            <p-delete-button :item="item" :action="route(id)">
                <b-button variant="danger">
                    <font-awesome-icon size="xs" icon="trash" />
                    <span class="pl-1">{{ trans("app.buttons.delete") }}</span>
                </b-button>
            </p-delete-button>
        </span>

        <b-button @click="cancel()" variant="secondary">
            <font-awesome-icon size="xs" icon="times" />
            <span class="pl-1">{{ trans("app.buttons.cancel") }}</span>
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
