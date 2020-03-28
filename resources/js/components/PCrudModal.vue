<template>
    <b-modal ref="custom-modal" id="modal" :title="title" @hide="handleHide">
        <b-container v-if="props.createMode" class="pb-3">{{
            createMessage
        }}</b-container>
        <component :is="component" v-bind="props" :action="action" />
        <template v-slot:modal-footer>
            <p-modal-footer
                v-bind="props"
                :action="action"
                :object="object"
                @toggle-edit="toggleEditMode"
            />
        </template>
    </b-modal>
</template>

<script>
import EventBus from "../eventBus";
import swal from "sweetalert";

export default {
    props: {
        action: String,
        createTitle: String,
        createMessage: String,
        detailsTitle: String,
        updateTitle: String,
        object: String,
    },

    data() {
        return {
            component: null,
            title: null,
            changes: true,
            props: {
                action: null,
                id: null,
                editMode: false,
                createMode: false,
                item: null,
            },
        };
    },

    methods: {
        show() {
            this.$refs["custom-modal"].show();
        },
        handleHide(evt) {
            if (this.props.editMode) {
                this.discardChanges();
                evt.preventDefault();
                return;
            }
            this.$nextTick(() => {
                this.$bvModal.hide("modal");
            });
        },
        toggleEditMode() {
            this.props.editMode = !this.props.editMode;
        },
        discardChanges() {
            swal({
                title: "Discard changes?",
                text:
                    "You have unsaved changes. Are you sure you want to leave?",
                icon: "warning",
                buttons: {
                    discard: {
                        text: "Discard changes",
                        value: "discard",
                    },
                    save: true,
                },
            }).then((value) => {
                switch (value) {
                    case "save":
                        EventBus.$emit("save");
                        swal({
                            text: "Your item has been saved!",
                            timer: 3000,
                        });
                        this.props.editMode = false;
                        this.handleHide();
                        break;

                    case "discard":
                        this.props.editMode = false;
                        this.handleHide();
                        break;
                }
            });
        },
        getProps(component, id) {
            this.component = component;
            this.props.id = id;
            axios.get(`/categories/${id}`).then((response) => {
                this.props.item = response.data;
            });
            this.show();
        },
    },

    mounted() {
        EventBus.$on("create-item", ({ component }) => {
            this.component = component;
            this.title = this.createTitle;
            this.props.createMode = true;
            this.show();
        });

        EventBus.$on("show-item", ({ component, id }) => {
            this.getProps(component, id);
            this.title = this.detailsTitle;
            this.props.editMode = false;
            this.props.createMode = false;
        });

        EventBus.$on("edit-item", ({ component, id }) => {
            this.getProps(component, id);
            this.title = this.updateTitle;
            this.props.editMode = true;
            this.props.createMode = false;
        });

        EventBus.$on("save", this.toggleEditMode);
        EventBus.$on("close-modal", this.handleHide);
    },
};
</script>
