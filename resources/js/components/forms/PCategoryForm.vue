<template>
   <ValidationObserver v-slot="{ invalid }">
      <form @submit.prevent="handleSubmit">
      <input :value="CSRFToken" type="hidden" name="_token">
      <p-text-input
         rules="required|min:3"
         type="text"
         label="Name:"
         name="name"
         v-model="name"
         placeholder="Enter your category name"
         :class="{ 'is-invalid': submitted && errors.has('name') }"
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
         <input type="submit" :disabled="invalid">
      </form>
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
    EventBus.$on('submit-form', this.handleSubmit)
  },
  
  methods: {
    async handleSubmit(){
      this.$validator.validateAll().then((result) => {
        if (result) {
            alert('Success')
        }
      });
      
      alert('error')
    }
  },
   
   provide () {
      return { parentValidator: this.$validator }
   },
}
</script>