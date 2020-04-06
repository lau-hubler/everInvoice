<template>
    <b-row class="mx-4 mb-4 mt-2">
        <b-col>
            <b-row>
                <span>
                    <strong>
                        {{ trans("invoice.invoiceDate.label") }}
                    </strong>
                    {{ item.invoice_date }}
                </span>
            </b-row>
            <b-row>
                <span>
                    <strong>
                        {{ trans("invoice.deliveryDate.label") }}
                    </strong>
                    {{ item.delivery_date }}
                </span>
            </b-row>
            <b-row>
                <span>
                    <strong>{{ trans("invoice.dueDate.label") }}</strong>
                    {{ item.due_date }}
                </span>
            </b-row>
        </b-col>
        <b-col>
            <b-row>
                <span>
                    <strong>{{ trans("invoice.status.label") }}</strong>
                    {{ item.status.name }}
                </span>
            </b-row>
            <b-row>
                <span>
                    <strong>{{ trans("app.createdAt") }}:</strong>
                    {{ item.created_at | dateTime }}
                </span>
            </b-row>
            <b-row>
                <span>
                    <strong>{{ trans("app.updatedAt") }}:</strong>
                    {{ item.updated_at | dateTime }}
                </span>
            </b-row>
        </b-col>
        <b-col>
            <b-row>
                <span>
                    <strong>Total: </strong> {{ totalToPay() | money }}
                </span>
            </b-row>
            <b-row>
                <span>
                    <strong>IVA: </strong> {{ totalIva() | money }}
                </span>
            </b-row>
            <b-row></b-row>
        </b-col>
    </b-row>
</template>
<script>
export default {
    name: "PInvoiceHeader",

    props: {
        item: {},
    },

    methods: {
        totalPrice(order) {
            return order.quantity * order.unit_price;
        },
        ivaOrder(order) {
            return this.totalPrice(order) * order.product_iva;
        },
        totalIva(){
            return  this.item.orders.reduce((sum, order) => sum + this.ivaOrder(order), 0)
        },
        totalToPay() {
            return this.item.orders.reduce((sum, order) => sum + this.totalPrice(order), 0)
        },
    }
};
</script>
