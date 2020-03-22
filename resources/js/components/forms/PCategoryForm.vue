<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form
            @submit.prevent="validate().then(onSubmit)"
        >
            <input :value="CSRFToken" type="hidden" name="_token">
            <p-text-input
                rules="required|min:3"
                type="text"
                :label="trans('category.name.label')"
                name="name"
                v-model="name"
                :placeholder="trans('category.name.placeholder')"
            />
            <p-text-input
                rules="required|min:5"
                type="text"
                :label="trans('category.description.label')"
                name="description"
                v-model="description"
                :placeholder="trans('category.description.placeholder')"
            />
            <p-text-input
                rules="required|max_value:100|min_value:0"
                type="text"
                :label="trans('category.iva.label')"
                name="iva"
                v-model="iva"
                :placeholder="trans('category.iva.placeholder')"
                append="%"
                :description="trans('category.iva.description')"
            />
            <b-button hidden ref="submit-btn" type="submit" />
      </b-form>
  </ValidationObserver>
</template>

<script>
import { ValidationObserver } from "vee-validate";
import PTextInput from "../inputs/PTextInput";
import EventBus from "../../eventBus";

export default {
    name: "PCategoryForm",

    props: {
        route: {
            type: String
        },
    },

    components: {
        ValidationObserver,
        PTextInput,
    },

    data: () => ({
        name: "",
        description: "",
        iva: "",
        CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
    }),

    created () {
        EventBus.$on('submit-form', this.submitForm)
    },

    methods: {
        onSubmit() {
            const params = {
                name: this.name,
                description: this.description,
                iva: this.convertedIva()
            }

            axios.post(this.route, params)
                .then((response) => {
                    const category = response.data
                    EventBus.$emit('new-category', category)
                    EventBus.$emit('close-modal')
            })
        },

        submitForm() {
            this.$refs["submit-btn"].click()
        },

        convertedIva() {
            return  this.iva / 100
        }
    }
};
</script>
