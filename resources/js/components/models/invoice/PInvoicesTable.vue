<template>
    <div class="overflow-auto">
        <b-table
            id="invoices-table"
            :items="filteredInvoices"
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
            filters: [],
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

        filteredInvoices() {
            let filtered = [];
            let invoices = this.invoices;

            if (this.filterEmpty()) {
                return invoices;
            }
            filtered = this.filterORTags(filtered, invoices);
            filtered = this.filterANDTags(filtered);
            return filtered;
        },
        ANDTags() {
            return this.filters
                .filter((searchTag) => searchTag.includes("+"))
                .map((searchTag) => searchTag.slice(1));
        },
        ORTags() {
            return this.filters.filter(
                (searchTag) => _.findIndex(this.ANDTags, searchTag) === -1
            );
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

        filterEmpty() {
            return (
                this.filters &&
                this.filters.constructor === Array &&
                this.filters.length === 0
            );
        },
        filterORTags(filtered, invoices) {
            let eachFilter = (invoice, filter) =>
                this.eachFilter(invoice, filter);

            this.ORTags.forEach(function (filter) {
                invoices
                    .filter((invoice) => eachFilter(invoice, filter))
                    .map((invoice) => {
                        if (filtered.includes(invoice) === false)
                            filtered.push(invoice);
                    });
            });
            return filtered;
        },
        filterANDTags(invoices) {
            let filtered = invoices;
            let eachFilter = (invoice, filter) =>
                this.eachFilter(invoice, filter);

            this.ANDTags.forEach(function (filter) {
                filtered = filtered.filter((invoice) =>
                    eachFilter(invoice, filter)
                );
            });
            return filtered;
        },
        eachFilter(invoice, filter) {
            return (
                this.filterDueDate(invoice, filter) ||
                this.filterClient(invoice, filter) ||
                this.filterVendor(invoice, filter) ||
                this.filterId(invoice, filter) ||
                this.filterStatus(invoice, filter)
            );
        },
        filterId(invoice, filter) {
            return invoice.id == filter;
        },
        filterClient(invoice, filter) {
            return this.getName(invoice.client)
                .toLowerCase()
                .includes(filter.toLowerCase());
        },
        filterVendor(invoice, filter) {
            return this.getName(invoice.vendor)
                .toLowerCase()
                .includes(filter.toLowerCase());
        },
        filterDueDate(invoice, filter) {
            if (this.isBetweenDates(filter)) {
                return this.filterBetweenDates(invoice.due_date,filter);
            }
            return invoice.due_date === this.formatDateToSearch(filter);
        },
        filterBetweenDates(date, filter) {
            let dates = filter.split("-");
            let startDate = new Date(this.formatDateToSearch(dates[0]));
            let endDate = new Date(this.formatDateToSearch(dates[1]));
            date = new Date(date);

            return date >= startDate && date <= endDate;
        },
        formatDateToSearch(date) {
            const dateInArray = date.split("/");
            return `${dateInArray[2]}-${dateInArray[0]}-${dateInArray[1]}`;
        },
        filterStatus(invoice, filter) {
            return invoice.status.name === filter;
        },
        isBetweenDates(date) {
            return date.includes("-");
        },
    },

    created() {
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

        EventBus.$on("search-invoice", (filters) => (this.filters = filters));
    },
};
</script>
