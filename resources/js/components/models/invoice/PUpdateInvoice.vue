<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <h4 class="mx-4 mb-3 mt-1 pl-1">
            {{ trans("invoice.id") }}{{ item.id }}
        </h4>
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-invoice-form v-model="item" :id="id"></p-invoice-form>
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
    name: "PUpdateInvoice",
    components: { PInvoiceForm, ValidationObserver },

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
                    client_id: this.item.client_id,
                    vendor_id: this.item.vendor_id,
                    due_date: this.item.due_date,
                    delivery_date: this.item.delivery_date,
                    invoice_date: this.item.invoice_date,
                    status_id: this.item.status_id,
                };
                api.updateItem("invoice", this.id, params).then((invoice) => {
                    EventBus.$emit("update-invoice", invoice);
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
