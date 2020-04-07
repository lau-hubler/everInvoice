<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-category-form v-model="item" :id="id"></p-category-form>
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
    name: "PUpdateCategory",
    components: { PCategoryForm, ValidationObserver },

    props: {
        action: String,
        id: Number,
    },

    data() {
        return {
            item: null,
            original: null,
        };
    },

    created() {
        axios.get(this.route(this.id)).then((response) => {
            this.item = response.data;
            this.item.iva *= 100;
            this.original = { ...this.item };
        });
        EventBus.$on("save", this.submitForm);
    },

    methods: {
        onSubmit() {
            if (!_.isEqual(this.original, this.item)) {
                const params = {
                    code: this.item.code,
                    name: this.item.name,
                    description: this.item.description,
                    iva: this.convertedIva(this.item.iva),
                };
                api.updateItem("category", this.id, params).then((category) => {
                    EventBus.$emit("update-category", category);
                    EventBus.$emit("saved");
                });
            } else {
                EventBus.$emit("saved");
            }
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },

        convertedIva(iva) {
            return iva / 100;
        },

        route(id) {
            return `${this.action}/${id}`;
        },
    },
};
</script>
