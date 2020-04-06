<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-product-form v-model="item" :id="id"></p-product-form>
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
    name: "PUpdateProduct",
    components: { PProductForm, ValidationObserver },

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
                    price: this.item.price,
                    category_id: this.item.category_id,
                };
                api.updateItem("product", this.id, params).then((product) => {
                    EventBus.$emit("update-product", product);
                    EventBus.$emit("saved");
                });
            } else {
                EventBus.$emit("saved");
            }
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },

        route(id) {
            return `${this.action}/${id}`;
        },
    },
};
</script>
