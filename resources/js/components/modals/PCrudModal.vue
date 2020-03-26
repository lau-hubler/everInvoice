<template>
    <b-modal ref="custom-modal" id="modal" :title="title" @hide="handleHide">
        <component :is="component" v-bind="props" :action="action" />
        <template v-slot:modal-footer>
            <p-modal-footer />
        </template>
    </b-modal>
</template>

<script>
import EventBus from "../../eventBus";
import swal from "sweetalert";

export default {
    props: {
        action: {
            type: String,
        },
    },

    data() {
        return {
            component: null,
            title: null,
            props: null,
            editMode: false,
        };
    },

    methods: {
        show() {
            this.$refs["custom-modal"].show();
        },
        handleHide(evt) {
            if (this.editMode) {
                this.discardChanges();
                evt.preventDefault();
                return;
            }
            this.$nextTick(() => {
                this.$bvModal.hide("modal");
            });
        },
        toggleEditMode() {
            this.editMode = !this.editMode;
        },
        discardChanges() {
            swal({
                title: "Discard changes?",
                text:
                    "You have unsaved changes. Are you sure you want to leave?",
                icon: "warning",
                buttons: ["Discard change", "Save it"],
                closeOnClickOutside: false,
            }).then((willSave) => {
                if (willSave) {
                    EventBus.$emit("save")
                    swal({
                        text: "Your item has been saved!",
                        timer: 3000,
                    });
                }
                this.editMode = false;
                this.handleHide();
            });
        },
    },

    mounted() {
        EventBus.$on("show-item", ({ component, title, props = null }) => {
            this.component = component;
            this.title = title;
            this.props = props;
            this.show();
        });

        EventBus.$on("edit", this.toggleEditMode);
        EventBus.$on("save", this.toggleEditMode);
        EventBus.$on("close-modal", this.handleHide);
    },
};
</script>
