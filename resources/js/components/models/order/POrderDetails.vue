<template>
    <b-tr>
        <b-td class="text-center align-middle" style="max-width: 50px;">
            {{ value.quantity }}
        </b-td>

        <b-td class="align-middle" style="min-width: 300px">
            {{value.product.code}} - {{ value.product.name }}
        </b-td>

        <b-td class="text-center align-middle" style="max-width: 100px;">
            {{ value.unit_price | money }}
        </b-td>

        <b-td class="text-center align-middle">{{ totalPrice | money }}</b-td>

        <b-td class="text-center align-middle">{{ ivaOrder | money }}</b-td>

        <b-td class="text-center align-middle" style="max-width: 90px;">
            {{ value.product_iva | percentage }}
        </b-td>

        <b-td class="text-center align-middle">
            {{ totalWithoutIva | money }}
        </b-td>

        <b-td class="text-center align-middle">
            <slot />
        </b-td>
    </b-tr>
</template>

<script>
import api from "../../../api";
import POrderForm from "../../forms/POrderForm";

export default {
    name: "POrderDetails",

    components: { POrderForm },

    props: {
        value: {},
    },

    data() {
        return {
            products: "",
        };
    },

    computed: {
        totalPrice() {
            return this.value.quantity * this.value.unit_price;
        },
        ivaOrder() {
            return (this.totalPrice * this.value.product_iva) / 100;
        },
        totalWithoutIva() {
            return this.totalPrice - this.ivaOrder;
        },
    },

    methods: {
        prepareOptions() {
            return this.products.map(function (product) {
                return {
                    value: product.id,
                    text: `${product.code} - ${product.name}`,
                };
            });
        },
    },

    created() {
        api.getClass("product").then((products) => (this.products = products));
    },
};
</script>
