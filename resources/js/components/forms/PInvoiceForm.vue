<template>
    <ValidationObserver ref="observer">
        <b-form-row class="mx-4">
            <b-col>
                <p-date-input
                    rules="required"
                    :label="trans('invoice.invoiceDate.label')"
                    name="invoice_date"
                    vid="invoiceDate"
                    v-model="invoice.invoice_date"
                />
            </b-col>
            <b-col>
                <p-date-input
                    rules="required"
                    :label="trans('invoice.deliveryDate.label')"
                    name="delivery_date"
                    vid="deliveryDate"
                    v-model="invoice.delivery_date"
                />
            </b-col>
            <b-col>
                <p-date-input
                    rules="required"
                    :label="trans('invoice.dueDate.label')"
                    name="due_date"
                    vid="dueDate"
                    v-model="invoice.due_date"
                />
            </b-col>
            <b-col>
                <p-select-input
                    rules="required"
                    :options="statusOptions()"
                    label-align-sm="left"
                    :label="trans('invoice.status.label')"
                    name="status_id"
                    v-model="invoice.status_id"
                    :placeholder="trans('invoice.status.placeholder')"
                />
            </b-col>
        </b-form-row>
        <b-form-row class="justify-content-center">
            <b-card-group deck class="container px-3">
                <b-card>
                    <b-card-title>
                        {{ trans("invoice.client.label") }}
                    </b-card-title>
                    <b-card-text>
                        <p-select-input
                            rules="required"
                            :options="stakeholderOptions()"
                            name="client_id"
                            vid="client"
                            v-model="invoice.client_id"
                            :placeholder="trans('invoice.client.placeholder')"
                        />
                        <p-stakeholder-for-invoice :item="invoice" />
                    </b-card-text>
                </b-card>
                <b-card>
                    <b-card-title>
                        {{ trans("invoice.vendor.label") }}
                    </b-card-title>
                    <b-card-text>
                        <p-select-input
                            rules="required|is_not:client"
                            :options="stakeholderOptions()"
                            name="vendor_id"
                            v-model="invoice.vendor_id"
                            :placeholder="trans('invoice.vendor.placeholder')"
                        />
                    </b-card-text>
                </b-card>
            </b-card-group>
        </b-form-row>

        <input :value="CSRFToken" type="hidden" name="_token" />
    </ValidationObserver>
</template>

<script>
import { ValidationObserver, Validator } from "vee-validate";
import numeral from "numeral";
import api from "../../api";

export default {
    name: "PInvoiceForm",

    components: { ValidationObserver },

    props: {
        value: {
            type: null,
        },
        id: null,
    },

    data: () => ({
        invoice: "",
        invoices: null,
        CSRFToken: document.head.querySelector("[name=csrf-token][content]")
            .content,
        stakeholders: {},
        statuses: {},
    }),

    computed: {
        client: {
            get() {
                return _.find(this.stakeholders, { id: this.invoice_id });
            },
            set(newVal) {
                this.invoice.client_id = newVal;
            },
        },
    },

    watch: {
        invoice(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.invoice = newVal;
        },
    },

    methods: {
        stakeholderOptions() {
            return this.stakeholders.map(function (stakeholder) {
                return {
                    value: stakeholder.id,
                    text: `${stakeholder.document_type.acronym} ${stakeholder.document} - ${stakeholder.name} ${stakeholder.surname}`,
                };
            });
        },
        statusOptions() {
            return this.statuses.map(function (status) {
                return {
                    value: status.id,
                    text: status.name,
                };
            });
        },
    },

    created() {
        if (this.value) {
            this.invoice = this.value;
        }
        api.getClass("invoice").then((invoices) => (this.invoices = invoices));
        api.getClass("stakeholder").then(
            (stakeholders) => (this.stakeholders = stakeholders)
        );
        api.getClass("status").then((statuses) => (this.statuses = statuses));
    },
};
</script>
