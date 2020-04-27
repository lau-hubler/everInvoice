<template>
    <div class="overflow-auto">
        <b-table
            id="transactions-table"
            :items="transactions"
            :fields="fields"
            striped
            hover
            sort-icon-left
            no-border-collapse
            empty-text="There is no transaction for this invoice"
            show-empty
        >
            <template v-slot:cell(status)="data">
                {{ data.value.name }}
            </template>
            <template v-slot:cell(created_at)="data">
                {{ data.value | dateTime }}
            </template>
        </b-table>
    </div>
</template>

<script>
import api from "../../../api";

export default {
    name: "PTransactions.vue",

    props: { id: null },

    data() {
        return {
            transactions: [],
            fields: [
                {
                    key: "request_id",
                    label: "Request ID",
                    sortable: true,
                },
                {
                    key: "reference",
                    label: "Reference",
                    sortable: true,
                },
                {
                    key: "url",
                },
                {
                    key: "status",
                    label: "Status",
                    sortable: true,
                },
                {
                    key: "created_at",
                    sortable: true,
                },
                {
                    key: "actions",
                    label: "",
                },
            ],
        };
    },

    created() {
        const headers = api.getHeader();
        axios
            .get(`/api/invoices/${this.id}/transactions`)
            .then((response) => response.data)
            .then((response) => (this.transactions = response));
    },
};
</script>
