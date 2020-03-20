<template>
  <ValidationProvider
  ref="validationProvider"
  :vid="vid"
  :name="$attrs.name"
  :rules="rules"
  v-slot="{ errors, validated }"
  >
    <b-form-group
    :description="description"
    :label="label"
    :label-for="$attrs.id"
    >
        <b-form-input
          v-model="innerValue"
          v-bind="$attrs"
          :state="errors[0] ? false : (validated ? true : null)"
        >
        </b-form-input>
        <b-form-invalid-feedback :state="errors[0] ? false : null">
          {{ errors[0] }}
        </b-form-invalid-feedback>
    </b-form-group>
  </ValidationProvider>
</template>

<script>
import { ValidationProvider } from "vee-validate";

export default {
  components: {
    ValidationProvider
  },
   
   inject: [ 'parentValidator' ],

  props: {
    vid: {
      type: String
    },
    rules: {
      type: [Object, String],
      default: ''
    },
    label: {
        type: String,
        default: null
    },
    description: {
        type: String,
        default: null
    },
    error: {
      default: null,
    },
     value: {
        type: null
     }
  },

   data: () => ({
      innerValue: ''
   }),
   
   watch: {
      // Handles internal model changes.
      innerValue (newVal) {
         this.$emit('input', newVal);
      },
      // Handles external model changes.
      value (newVal) {
         this.innerValue = newVal;
      }
   },
   
   created () {
      this.$validator = this.parentValidator
      if (this.value) {
         this.innerValue = this.value;
      }
   },

  mounted() {
    if (this.error) {
        this.addError(this.error);
    }
  },

  methods: {
    addError(error) {
        this.$refs.validationProvider.setErrors([this.error]);
    }
  },
};
</script>