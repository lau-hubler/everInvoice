<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-category-form v-model="item"></p-category-form>
            <b-button hidden ref="submit-btn" type="submit" />
        </b-form>
    </ValidationObserver>
</template>

<script>
import PCategoryForm from "../forms/PCategoryForm";
import EventBus from "../../eventBus";
import { ValidationObserver } from "vee-validate";

export default {
    name: "PUpdateCategory",

    props: {
        action: String,
        value: {
            type: null,
        },
    },

    components: { PCategoryForm, ValidationObserver },

    data: () => ({
        item: null,
    }),

    created() {
        if (this.value) {
            this.item = this.value;
            this.item.iva = this.value.iva * 100;
        }
        EventBus.$on("save", this.submitForm);
    },

    methods: {
        onSubmit() {
            const params = {
                name: this.item.name,
                description: this.item.description,
                iva: this.convertedIva(this.item.iva),
            };
            axios.put(this.route(this.value), params).then((response) => {
                const category = response.data;
                EventBus.$emit("update-category", category);
                EventBus.$emit("close-modal");
            });
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },

        convertedIva(iva) {
            return iva / 100;
        },

        route(item) {
            return `${this.action}/${item.id}`;
        },
    },
};
</script>
