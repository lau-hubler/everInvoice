<template>
    <ValidationObserver ref="observer">
        <input :value="CSRFToken" type="hidden" name="_token">
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
            rules="required|max_value:100|min_value:0"
            type="text"
            :label="trans('category.iva.label')"
            name="iva"
            v-model="category.iva"
            :placeholder="trans('category.iva.placeholder')"
            append="%"
            :description="trans('category.iva.description')"
        />
    </ValidationObserver>
</template>

<script>
    import PTextInput from "../inputs/PTextInput";
    import {ValidationObserver} from "vee-validate";

    export default {
        name: "PCategoryForm",

        components: { PTextInput, ValidationObserver },

        props: {
            value: {
                type: null
            } },

        data: () => ({
            category: "",
            CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
        }),

        watch: {
            innerValue (newVal) {
                this.$emit('input', newVal);
            },

            value (newVal) {
                this.innerValue = newVal;
            }
        },

        created () {
            if (this.value) {
                this.category = this.value;
            }
        }
    }
</script>
