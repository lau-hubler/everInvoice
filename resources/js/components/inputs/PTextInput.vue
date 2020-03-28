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
            <b-input-group v-bind="$attrs">
                <b-form-input
                    v-model="innerValue"
                    v-bind="$attrs"
                    :state="errors[0] ? false : validated ? true : null"
                >
                </b-form-input>
            </b-input-group>
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
        ValidationProvider,
    },

    props: {
        vid: {
            type: String,
        },
        rules: {
            type: [Object, String],
            default: "",
        },
        value: {
            type: null,
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
