<template>
    <b-container>
        <b-row class="mx-4">
            <h4>{{ trans("invoice.id") }}{{ item.id }}</h4>
        </b-row>
        <p-invoice-header :item="item" />
        <b-row class="justify-content-center">
            <b-card-group deck class="container px-3">
                <b-card>
                    <b-card-title>
                        {{ trans("invoice.client.label") }}
                    </b-card-title>
                    <b-card-text>
                        <p-stakeholder-for-invoice
                            :item="item.client"
                        ></p-stakeholder-for-invoice>
                    </b-card-text>
                </b-card>
                <b-card>
                    <b-card-title>
                        {{ trans("invoice.vendor.label") }}
                    </b-card-title>
                    <b-card-text>
                        <p-stakeholder-for-invoice
                            :item="item.vendor"
                        ></p-stakeholder-for-invoice>
                    </b-card-text>
                </b-card>
            </b-card-group>
        </b-row>
        <div class="m-3">
            <b-tabs content-class="mt-3">
                <b-tab title="Orders" active
                    ><p-orders-table :items="item.orders" :invoiceId="item.id"
                /></b-tab>
                <b-tab title="Transactions"
                    ><p-transactions :id="item.id"></p-transactions
                ></b-tab>
            </b-tabs>
        </div>
    </b-container>
</template>

<script>
import PInvoiceHeader from "./PInvoiceHeader";
import POrdersTable from "../order/POrdersTable";

export default {
    name: "PInvoiceDetails",
    components: { POrdersTable, PInvoiceHeader },
    props: {
        item: null,
    },
};
</script>
