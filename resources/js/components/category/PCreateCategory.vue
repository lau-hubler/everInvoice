<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-category-form v-model="item"></p-category-form>
            <b-button hidden ref="submit-btn" type="submit" />
        </b-form>
    </ValidationObserver>
</template>

<script>
import PCategoryForm from "../forms/PCategoryForm"
import EventBus from "../../eventBus";
import {ValidationObserver} from "vee-validate";


export default {
    name: "PCreateCategory",

    components: { PCategoryForm, ValidationObserver },

    props: {
        action: String,
        createMessage: String
    },

    data: () => ({
        item: {
            name: "",
            description: "",
            iva: ""
        }
    }),

    created () {
        EventBus.$on('create', this.submitForm)
    },

    methods: {
        onSubmit() {
            const params = {
                name: this.item.name,
                description: this.item.description,
                iva: this.convertedIva()
            }

            axios.post(this.action, params)
                .then((response) => {
                    const category = response.data
                    EventBus.$emit('new-category', category)
                    EventBus.$emit('close-modal')
            })
        },

        submitForm() {
            this.$refs["submit-btn"].click()
        },

        convertedIva() {
            return  this.item.iva / 100
        }
    }
};
</script>
