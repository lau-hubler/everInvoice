<template>
    <ValidationObserver ref="observer">
        <input :value="CSRFToken" type="hidden" name="_token" />
        <p-text-input
            rules="required|alpha_num|length:6|unique"
            type="text"
            :label="trans('category.code.label')"
            name="code"
            v-model="category.code"
            :placeholder="trans('category.code.placeholder')"
            format="uppercase"
        />
        <p-text-input
            rules="required|min:3"
            type="text"
            :label="trans('category.name.label')"
            name="name"
            v-model="category.name"
            :placeholder="trans('category.name.placeholder')"
        />
        <p-text-input
            rules="required|min:5"
            type="text"
            :label="trans('category.description.label')"
            name="description"
            v-model="category.description"
            :placeholder="trans('category.description.placeholder')"
        />
        <p-text-input
            rules="required|between:0,100"
            type="text"
            :label="trans('category.iva.label')"
            name="iva"
            v-model="category.iva"
            :placeholder="trans('category.iva.placeholder')"
            append="%"
            format="percentage"
            :description="trans('category.iva.description')"
        />
    </ValidationObserver>
</template>

<script>
import PTextInput from "../inputs/PTextInput";
import { ValidationObserver, Validator } from "vee-validate";

export default {
    name: "PCategoryForm",

    components: { PTextInput, ValidationObserver },

    props: {
        value: {
            type: null,
        },
        id: null
    },

    data: () => ({
        category: "",
        categories: null,
        CSRFToken: document.head.querySelector("[name=csrf-token][content]")
            .content,
    }),

    watch: {
        category(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.category = newVal;
        },
    },

    created() {
        if (this.value) {
            this.category = this.value;
        }
        axios.get("/categories").then((response) => {
            this.categories = response.data;
        });
    },
    mounted() {
        const isUnique = (value) =>
            new Promise((resolve) => {
                setTimeout(() => {
                     let original = _.find(this.categories, { id: this.id})
                    if (
                        _.findIndex(this.categories, { code: value }) === -1 || original.code === value
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
