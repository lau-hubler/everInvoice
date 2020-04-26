<template>
    <ValidationObserver ref="observer">
        <input :value="CSRFToken" type="hidden" name="_token" />
        <p-text-input
            rules="required|alpha_num|length:6|unique"
            type="text"
            :label="trans('product.code.label')"
            label-cols-sm="3"
            name="code"
            v-model="product.code"
            :placeholder="trans('product.code.placeholder')"
            format="uppercase"
        />
        <p-text-input
            rules="required|min:3"
            type="text"
            :label="trans('product.name.label')"
            label-cols-sm="3"
            name="name"
            v-model="product.name"
            :placeholder="trans('product.name.placeholder')"
        />
        <p-text-input
            rules="required|min:5"
            type="text"
            :label="trans('product.description.label')"
            label-cols-sm="3"
            name="description"
            v-model="product.description"
            :placeholder="trans('product.description.placeholder')"
        />
        <p-text-input
            rules="required|min_value:0"
            type="text"
            :label="trans('product.price.label')"
            label-cols-sm="3"
            name="price"
            v-model="product.price"
            :placeholder="trans('product.price.placeholder')"
            prepend="$"
            format="money"
        />
        <p-select-input
            rules="required"
            :options="prepareOptions()"
            :label="trans('product.category.label')"
            label-cols-sm="3"
            label-align-sm="right"
            name="category_id"
            v-model="product.category_id"
            :placeholder="trans('product.category.placeholder')"
            :description="trans('product.category.description')"
        />
    </ValidationObserver>
</template>

<script>
import PTextInput from "../inputs/PTextInput";
import { ValidationObserver, Validator } from "vee-validate";
import numeral from "numeral";
import api from "../../api";

export default {
    name: "PProductForm",

    components: { PTextInput, ValidationObserver },

    props: {
        value: {
            type: null,
        },
        id: null,
    },

    data: () => ({
        product: "",
        products: null,
        CSRFToken: document.head.querySelector("[name=csrf-token][content]")
            .content,
        categories: {},
    }),

    watch: {
        product(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.product = newVal;
        },
    },

    methods: {
        prepareOptions() {
            return this.categories.map(function (category) {
                return {
                    value: category.id,
                    text: `${category.code} - ${category.name} - ${numeral(
                        category.iva
                    ).format("0.0[0]%")}`,
                };
            });
        },
    },

    created() {
        if (this.value) {
            this.product = this.value;
        }
        api.getClass("product").then((products) => (this.products = products));
        api.getClass("category").then(
            (categories) => (this.categories = categories)
        );
    },

    mounted() {
        const isUnique = (value) =>
            new Promise((resolve) => {
                setTimeout(() => {
                    let original = { code: null };
                    if (this.id) {
                        original = _.find(this.products, { id: this.id });
                    }
                    if (
                        _.findIndex(this.products, { code: value }) === -1 ||
                        original.code === value
                    ) {
                        return resolve({
                            valid: true,
                        });
                    }

                    return resolve({
                        valid: false,
                        data: {
                            message: `${value} already exists.`,
                        },
                    });
                }, 200);
            });

        Validator.extend("unique", {
            validate: isUnique,
            getMessage: (field, params, data) => data.message,
        });
    },
};
</script>
