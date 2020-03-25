<template>
    <b-modal ref="custom-modal" id="modal" :title="title" @hide="handleHide">
        <component :is="component" v-bind="props" :route="action" />
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
        title: {
            type: String,
            default: "Showing Details"
        },
        item: Object,
        action: {
            type: String
        }
    },

    data() {
        return {
            component: null,
            props: null,
            editMode: false
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
                buttons: ["Discard change", "Save it"]
            }).then(willSave => {
                if (willSave) {
                    swal({
                        text: "Your item has been saved!",
                        timer: 3000
                    });
                }
                this.editMode = false;
                this.handleHide();
            });
        }
    },

    mounted() {
        EventBus.$on("show-item", ({ component, props = null }) => {
            this.component = component;
            this.props = props;
            this.show();
        });

        EventBus.$on("close-modal", this.handleHide);
        EventBus.$on("edit", this.toggleEditMode);
    }
};
</script>
