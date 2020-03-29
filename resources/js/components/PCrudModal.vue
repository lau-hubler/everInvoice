<template>
    <b-modal ref="custom-modal" id="modal" :title="title" @hide="handleHide">
        <b-container v-if="props.createMode" class="pb-3">
            {{ createMessage }}
        </b-container>
        <component :is="component" v-bind="props" :action="action" />
        <template v-slot:modal-footer>
            <p-modal-footer
                v-bind="props"
                :action="action"
                :object="object"
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
        discardTitle: String,
        discardMessage: String,
        discardButton: String,
        saveChangesButton: String,
        savedMessage: String,
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
        getProps(component, id) {
            this.component = component;
            this.props.id = id;
            axios.get(`/categories/${id}`).then((response) => {
                this.props.item = response.data;
            });
            this.show();
        },
        show() {
            this.$refs["custom-modal"].show();
        },
        handleHide(evt) {
            if (this.props.editMode || this.props.createMode) {
                this.discardChanges();
                evt.preventDefault();
                return;
            }
            this.$nextTick(() => {
                this.$bvModal.hide("modal");
            });
        },
        discardChanges() {
            swal({
                title: this.discardTitle,
                text: this.discardMessage,
                icon: "warning",
                buttons: {
                    discard: {
                        text: this.discardButton,
                        value: "discard",
                    },
                    save: {
                        text: this.saveChangesButton,
                        value: "save",
                    },
                },
            }).then((value) => {
                switch (value) {
                    case "save":
                        EventBus.$emit("save");
                        EventBus.$emit("create");
                        break;

                    case "discard":
                        this.setShowMode();
                        this.handleHide();
                        break;
                }
            });
        },
        confirmSaved() {
            swal({
                text: this.savedMessage,
                timer: 3000,
            });
            this.setShowMode();
            this.handleHide();
        },
        setShowMode() {
            this.props.editMode = false;
            this.props.createMode = false;
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
            this.setShowMode();
        });

        EventBus.$on("edit-item", ({ component, id }) => {
            this.getProps(component, id);
            this.title = this.updateTitle;
            this.setShowMode();
            this.props.editMode = true;
        });

        EventBus.$on("saved", this.confirmSaved);
        EventBus.$on("close-modal", this.handleHide);
    },
};
</script>
