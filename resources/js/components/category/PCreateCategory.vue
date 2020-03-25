<template>
    <p-category-form v-model="category"></p-category-form>
</template>

<script>
import PCategoryForm from "../forms/PCategoryForm"
import EventBus from "../../eventBus";

export default {
    name: "PCreateCategory",

    props: {
        route: {
            type: String
        },
    },

    components: { PCategoryForm },

    data: () => ({
        category: {
            name: "",
            description: "",
            iva: ""
        }
    }),

    created () {
        EventBus.$on('submit-form', this.submitForm)
    },

    methods: {
        onSubmit() {
            const params = {
                name: this.name,
                description: this.description,
                iva: this.convertedIva()
            }

            axios.post(this.route, params)
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
            return  this.iva / 100
        }
    }
};
</script>
