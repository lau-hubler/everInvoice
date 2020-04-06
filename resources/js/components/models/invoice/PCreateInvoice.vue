<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-invoice-form v-model="item"></p-invoice-form>
            <b-button hidden ref="submit-btn" type="submit" />
        </b-form>
    </ValidationObserver>
</template>

<script>
import PInvoiceForm from "../../forms/PInvoiceForm";
import EventBus from "../../../eventBus";
import { ValidationObserver } from "vee-validate";
import api from "../../../api";

export default {
    name: "PCreateInvoice",

    components: { PInvoiceForm, ValidationObserver },

    data: () => ({
        item: {
            client_id: "",
            vendor_id: "",
            due_date: "",
            delivery_date: "",
            invoice_date: "",
            status_id: "",
        },
    }),

    created() {
        EventBus.$on("create", this.submitForm);
    },

    methods: {
        onSubmit() {
            const params = {
                client_id: this.item.client_id,
                vendor_id: this.item.vendor_id,
                due_date: this.item.due_date,
                delivery_date: this.item.delivery_date,
                invoice_date: this.item.invoice_date,
                status_id: this.item.status_id,
            };

            api.createItem("category", params).then((category) => {
                EventBus.$emit("new-invoice", invoice);
                EventBus.$emit("saved");
            });
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },
    },
};
</script>
