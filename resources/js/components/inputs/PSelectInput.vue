<template>
    <ValidationProvider
        ref="validationProvider"
        :vid="vid"
        :name="$attrs.name"
        :rules="rules"
        v-slot="{ errors, validated }"
    >
        <b-form-group
            label-cols-sm="3"
            label-align-sm="right"
            label-class="font-weight-bold"
            :label-for="$attrs.id"
            v-bind="$attrs"
        >
            <b-form-select
                v-model="innerValue"
                :options="options"
                v-bind="$attrs"
                :state="errors[0] ? false : validated ? true : null"
            >
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled>-- {{ placeholder }} --</b-form-select-option>
                </template>
            </b-form-select>

            <b-form-invalid-feedback :state="errors[0] ? false : null">
                {{ errors[0] }}
            </b-form-invalid-feedback>
        </b-form-group>
    </ValidationProvider>
</template>

<script>
import { ValidationProvider } from "vee-validate";
import numeral from "numeral";

export default {
    components: {
        ValidationProvider,
    },

    props: {
        vid: String,
        value: null,
        options: null,
        placeholder: String,
        rules: {
            type: [Object, String],
            default: "",
        },
    },

    data: () => ({
        innerValue: "",
    }),

    watch: {
        innerValue(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.innerValue = newVal;
        },
    },

    created() {
        if (this.value) {
            this.innerValue = this.value;
        }
    },
};
</script>
