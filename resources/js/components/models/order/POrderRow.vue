<template>
    <b-tr :is="component" v-model="modifiedOrder">
        <a class="btn-link" :class="editMode ? 'text-success' : 'text-primary'">
            <font-awesome-icon icon="save" @click="save" v-if="editMode" />
            <font-awesome-icon v-else icon="edit" @click="edit" />
        </a>
        <a class="btn btn-link text-secondary" v-if="editMode">
            <font-awesome-icon icon="times" @click="reset" />
        </a>
        <p-delete-button
            v-else
            :item="order"
            action="/orders"
            type="order"
            :name="order.product.name"
            close="false"
        >
            <font-awesome-icon icon="trash" />
        </p-delete-button>
    </b-tr>
</template>

<script>
import api from "../../../api";
import POrderForm from "../../forms/POrderForm";
import POrderDetails from "./POrderDetails";
import EventBus from "../../../eventBus";

export default {
    name: "POrderRow",

    components: { POrderForm, POrderDetails },

    props: {
        order: {},
    },

    data() {
        return {
            modifiedOrder: "",
            editMode: false,
            component: "p-order-details",
        };
    },

    methods: {
        toggleEditMode() {
            this.editMode = !this.editMode;
        },
        edit() {
            this.toggleEditMode();
            this.component = "p-order-form";
        },
        save() {
            api.updateItem("order", this.order.id, this.modifiedOrder);
            this.showDetails();
        },
        reset() {
            this.modifiedOrder = this.order;
            this.showDetails();
        },
        showDetails() {
            this.toggleEditMode();
            this.component = "p-order-details";
        },
    },

    created() {
        if (this.order) {
            this.modifiedOrder = { ...this.order };
        }
        EventBus.$on('delete-order',)
    },
};
</script>
