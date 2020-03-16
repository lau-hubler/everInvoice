<template>
  <ValidationObserver ref="observer">
    <b-form>
      <p-text-input
        rules="required|min:3"
        type="text"
        label="Name:"
        name="name"
        v-model="name"
        placeholder="Enter your category name"
      />
    </b-form>

    <b-form>
      <p-text-input
        rules="required|min:5"
        type="text"
        label="Description:"
        name="description"
        v-model="description"
        placeholder="Describe your category"
      />
    </b-form>

    <b-form>
      <p-text-input
        rules="required|max_value:100"
        type="text"
        label="IVA:"
        name="iva"
        v-model="iva"
        placeholder="19.0%"
        description="Type the iva for this category"
      />
    </b-form>
  </ValidationObserver>
</template>

<script>
import { ValidationObserver } from "vee-validate";
import PTextInputWithValidation from "../inputs/PTextInputWithValidation";

export default {
  name: "PCategoryForm",

  components: {
    ValidationObserver,
    PTextInputWithValidation,
  },

  data: () => ({
    name: "",
    description: "",
    iva: null,
    nameLabel: "",
  })
};
</script>