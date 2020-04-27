<template>
    <ValidationObserver is="b-tr" ref="observer">
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
    </ValidationObserver>
</template>

<script>
import api from "../../api";
import EventBus from "../../eventBus";
import { ValidationObserver } from "vee-validate";

export default {
    name: "POrderForm",

    components: { ValidationObserver },

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
            if (product) {
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
        resetForm() {
            this.modifiedOrder = {
                invoice_id: null,
                product_id: null,
                quantity: null,
                unit_price: null,
                product_iva: null,
            };

            this.$nextTick(() => {
                this.errors.clear();
                this.$nextTick(() => {
                    this.$validator.reset();
                });
            });
        },
    },

    created() {
        if (this.value) {
            this.modifiedOrder = this.value;
        }
        api.getClass("product").then((products) => (this.products = products));
        EventBus.$on("reset-order", this.resetForm);
    },
};
</script>
