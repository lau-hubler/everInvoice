<template>
    <div class="overflow-auto">
        <b-table
            id="invoices-table"
            :items="invoices"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            striped
            hover
            sort-icon-left
            no-border-collapse
            show-empty
            :empty-text="emptyTable"
            class="invoice-table"
        >
            <template v-slot:cell(client)="data">
                {{ getName(data.value) }}
            </template>
            <template v-slot:cell(vendor)="data">
                {{ getName(data.value) }}
            </template>
            <template v-slot:cell(due_date)="data">
                <span class="pl-5">{{ data.value | date }}</span>
            </template>
            <template v-slot:cell(status)="data">
                {{ data.value.name }}
            </template>
            <template v-slot:cell(actions)="row">
                <div class="btn-group btn-group-sm" role="group">
                    <p-link-button
                        :id="row.item.id"
                        object="invoice"
                        component="p-invoice-details"
                        event="show-item"
                    >
                        <font-awesome-icon icon="eye" />
                    </p-link-button>
                    <p-link-button
                        :id="row.item.id"
                        component="p-update-invoice"
                        object="invoice"
                        event="edit-item"
                        variant="text-primary"
                    >
                        <font-awesome-icon icon="edit" />
                    </p-link-button>
                    <p-delete-button
                        :item="row.item"
                        :action="action"
                        type="invoice"
                    >
                        <font-awesome-icon icon="trash" />
                    </p-delete-button>
                </div>
            </template>
        </b-table>
        <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            aria-controls="invoices-table"
            first-number
            last-number
        ></b-pagination>
    </div>
</template>

<script>
import EventBus from "../../../eventBus";
import _ from "lodash";
import api from "../../../api";

export default {
    name: "PInvoicesTable",

    props: {
        action: String,
    },

    data() {
        return {
            invoices: [],
            perPage: 10,
            currentPage: 1,
            emptyTable: _.get(window.i18n, "invoice.emptyMessage"),
            fields: [
                {
                    key: "id",
                    label: _.get(window.i18n, "invoice.number.title"),
                    sortable: true,
                    class: "text-center",
                },
                {
                    key: "client",
                    label: _.get(window.i18n, "invoice.client.title"),
                    sortable: true,
                },
                {
                    key: "vendor",
                    label: _.get(window.i18n, "invoice.vendor.title"),
                    sortable: true,
                },
                {
                    key: "due_date",
                    label: _.get(window.i18n, "invoice.dueDate.title"),
                    sortable: true,
                },
                {
                    key: "status",
                    label: _.get(window.i18n, "invoice.status.title"),
                    sortable: true,
                },
                {
                    key: "actions",
                    label: "",
                },
            ],
        };
    },

    computed: {
        rows() {
            return this.invoices.length;
        },
    },

    methods: {
        addInvoice(invoice) {
            this.invoices.push(invoice);
        },
        deleteInvoice(invoice) {
            const index = _.findIndex(this.invoices, {
                id: invoice.id,
            });
            this.$delete(this.invoices, index, invoice);
        },
        updateInvoice(invoice) {
            const index = _.findIndex(this.invoices, {
                id: invoice.id,
            });
            this.$set(this.invoices, index, invoice);
        },
        getName(stakeholder) {
            if (stakeholder.is_company) {
                return stakeholder.name;
            }
            return `${stakeholder.name} ${stakeholder.surname}`;
        },
    },

    mounted() {
        api.getClass("invoice").then((invoices) => (this.invoices = invoices));

        EventBus.$on("new-invoice", (invoice) => {
            this.addInvoice(invoice);
        });

        EventBus.$on("update-invoice", (invoice) => {
            this.updateInvoice(invoice);
        });

        EventBus.$on("delete-invoice", (invoice) => {
            this.deleteInvoice(invoice);
        });
    },
};
</script>
