<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-category-form v-model="item"></p-category-form>
            <b-button hidden ref="submit-btn" type="submit" />
        </b-form>
    </ValidationObserver>
</template>

<script>
import PCategoryForm from "../../forms/PCategoryForm";
import EventBus from "../../../eventBus";
import { ValidationObserver } from "vee-validate";
import api from "../../../api";

export default {
    name: "PCreateCategory",

    components: { PCategoryForm, ValidationObserver },

    data: () => ({
        item: {
            code: "",
            name: "",
            description: "",
            iva: "",
        },
    }),

    created() {
        EventBus.$on("create", this.submitForm);
    },

    methods: {
        onSubmit() {
            const params = {
                code: this.item.code,
                name: this.item.name,
                description: this.item.description,
                iva: this.convertedIva(),
            };
            api.createItem("category", params).then((category) => {
                EventBus.$emit("new-category", category);
                EventBus.$emit("saved");
            });
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },

        convertedIva() {
            return this.item.iva / 100;
        },
    },
};
</script>
