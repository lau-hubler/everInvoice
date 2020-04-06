<template>
    <b-tr>
        <b-td class="text-center align-middle">
            <div class="pt-3 mx-auto" style="max-width: 60px;">
                <p-text-input
                    rules="required|min_value:0"
                    type="text"
                    name="quantity"
                    v-model="modifiedOrder.quantity"
                    placeholder="0"
                />
            </div>
        </b-td>

        <b-td class="align-middle">
            <div class="pt-3 mx-auto">
                <p-select-input
                    rules="required"
                    :options="prepareOptions()"
                    name="product_id"
                    v-model="modifiedOrder.product_id"
                    :placeholder="trans('product.category.placeholder')"
                />
            </div>
        </b-td>

        <b-td class="text-center align-middle">
            <div class="pt-3 mx-auto" style="max-width: 100px;">
                <p-text-input
                    rules="required|min_value:0"
                    type="text"
                    name="unit_price"
                    prepend="$"
                    v-model="modifiedOrder.unit_price"
                    placeholder="00.00"
                />
            </div>
        </b-td>

        <b-td class="text-center align-middle">
            {{ totalPrice | money }}
        </b-td>

        <b-td class="text-center align-middle">
            {{ ivaOrder | money }}
        </b-td>

        <b-td class="align-middle">
            <div class="pt-3" style="max-width: 90px;">
                <p-text-input
                    rules="required|numeric"
                    type="text"
                    name="product_iva"
                    append="%"
                    v-model="iva"
                    placeholder="0"
                />
            </div>
        </b-td>

        <b-td class="text-center align-middle">
            {{ totalWithoutIva | money }}
        </b-td>

        <b-td class="text-center align-middle"><slot /></b-td>
    </b-tr>
</template>

<script>
import api from "../../api";

export default {
    name: "POrderForm",

    props: { value: null },

    data() {
        return {
            modifiedOrder: "",
            products: "",
        };
    },

    watch: {
        productId: function (newVal) {
            const product = _.find(this.products, { id: newVal });
            if (product){
                this.modifiedOrder.unit_price = product.price;
                this.modifiedOrder.product_iva = product.category.iva;
            }
        },
        modifiedOrder(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.modifiedOrder = newVal;
        },
    },

    computed: {
        totalPrice() {
            return this.modifiedOrder.quantity * this.modifiedOrder.unit_price;
        },
        ivaOrder() {
            return this.totalPrice * this.modifiedOrder.product_iva;
        },
        totalWithoutIva() {
            return this.totalPrice - this.ivaOrder;
        },
        productId() {
            return this.modifiedOrder.product_id;
        },
        iva: {
            get: function () {
                return this.modifiedOrder.product_iva * 100;
            },

            set: function (newValue) {
                this.modifiedOrder.product_iva = newValue / 100;
            },
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
        if (this.value) {
            this.modifiedOrder = this.value;
        }
        api.getClass("product").then((products) => (this.products = products));
    },
};
</script>
