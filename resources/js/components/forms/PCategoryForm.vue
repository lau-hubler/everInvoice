<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form
            @submit.prevent="validate().then(onSubmit)"
        >
            <input :value="CSRFToken" type="hidden" name="_token">
            <p-text-input
                rules="required|min:3"
                type="text"
                label="Name:"
                name="name"
                v-model="name"
                placeholder="Enter your category name"
            />
            <p-text-input
                rules="required|min:5"
                type="text"
                label="Description:"
                name="description"
                v-model="description"
                placeholder="Describe your category"
            />
            <p-text-input
                rules="required|max_value:100"
                type="text"
                label="IVA:"
                name="iva"
                v-model="iva"
                placeholder="19.0%"
                description="Type the iva for this category"
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

  components: {
    ValidationObserver,
    PTextInput,
  },

  data: () => ({
    email: "",
    name: "",
    description: "",
    iva: "",
    action: "",
    CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
  }),

  created () {
    EventBus.$on('submit-form', this.submitForm)
  },

    methods: {
        onSubmit() {

        },

        submitForm() {
            this.$refs["submit-btn"].click()
        }
    }
};
</script>
