<template>
  <ValidationProvider 
  ref="validationProvider"
  :vid="vid" 
  :name="$attrs.name" 
  :rules="rules"
  v-slot="{ errors, valid }"
  >
    <b-form-group
    :description="description"
    :label="label"
    :label-for="$attrs.id"
    >
        <b-form-input
          v-model="innerValue"
          v-bind="$attrs"
          :state="errors[0] ? false : (valid ? true : null)"
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
    }
  },

  data: () => ({
    innerValue: ''
  }),

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