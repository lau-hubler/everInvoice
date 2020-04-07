<template>
    <component is="p-order-form" v-model="modifiedOrder">
        <a v-b-hover class="btn btn-link text-success">
            <span class="font-weight-bold h4" @click="save()">+</span>
        </a>
        <a v-b-hover class="btn btn-link text-secondary">
            <font-awesome-icon icon="times" @click="reset()" />
        </a>
    </component>
</template>

<script>
import api from "../../../api";
import POrderForm from "../../forms/POrderForm";
import EventBus from "../../../eventBus";

export default {
    name: "POrderCreateRow",

    components: { POrderForm },

    props: { invoiceId: null },

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

    prepareOptions() {
        return this.products.map(function (product) {
            return {
                value: product.id,
                text: `${product.code} - ${product.name}`,
            };
        });
    },

    methods: {
        save() {
            const params = {
                invoice_id: this.invoiceId,
                ...this.modifiedOrder,
            };
            api.createItem("order", params).then((order) =>
                EventBus.$emit("create-order", order)
            );
        },
        reset() {
            EventBus.$emit("reset-order");
        },
    },
};
</script>
