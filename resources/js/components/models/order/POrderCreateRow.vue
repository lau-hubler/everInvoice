<template>
    <component is="p-order-form" v-model="modifiedOrder">
        <a class="btn btn-link text-success">
            <span class="font-weight-bold h4" @click="save">+</span>
        </a>
        <a class="btn btn-link text-secondary">
            <font-awesome-icon icon="times" @click="reset" />
        </a>
    </component>
</template>

<script>
import api from "../../../api";
import POrderForm from "../../forms/POrderForm";
import EventBus from "../../../eventBus";

export default {
    name: "POrderRow",

    components: { POrderForm },

    data() {
        return {
            modifiedOrder: {
                quantity: "",
                product_id: "",
                unit_price: "",
                product_iva: "",
            },
        };
    },

    methods: {
        save() {
            api.createItem("order", this.modifiedOrder).then((order) =>
                EventBus.$emit("create-order", order)
            );
            this.reset();
        },
        reset() {
            this.modifiedOrder = {};
        },
    },
};
</script>
