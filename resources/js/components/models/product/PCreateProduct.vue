<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-product-form v-model="item"></p-product-form>
            <b-button hidden ref="submit-btn" type="submit" />
        </b-form>
    </ValidationObserver>
</template>

<script>
import PProductForm from "../../forms/PProductForm";
import EventBus from "../../../eventBus";
import { ValidationObserver } from "vee-validate";
import api from "../../../api";

export default {
    name: "PCreateProduct",

    components: { PProductForm, ValidationObserver },

    data: () => ({
        item: {
            code: "",
            name: "",
            description: "",
            price: "",
            category_id: "",
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
                price: this.item.price,
                category_id: this.item.category_id,
            };

            api.createItem("product", params).then((product) => {
                EventBus.$emit("new-product", product);
                EventBus.$emit("saved");
            });
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },
    },
};
</script>
