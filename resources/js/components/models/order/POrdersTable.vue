<template>
    <div class="m-3">
        <div class="p-3 bg-secondary text-white border rounded-top">
            <h6 class="mb-0 h4">{{ trans("product.title") }}</h6>
        </div>
        <b-table-simple hover small outlined striped id="orders-table">
            <b-thead head-variant="light">
                <b-th class="text-center">Quantity</b-th>
                <b-th class="">Product</b-th>
                <b-th class="text-center">Unit Price</b-th>
                <b-th class="text-center">Total Price</b-th>
                <b-th colspan="2" class="text-center pr-4">IVA</b-th>
                <b-th class="text-center">Total without IVA</b-th>
                <b-th></b-th>
            </b-thead>
            <b-tbody>
                <template v-for="order in orders">
                    <p-order-row :order="order" />
                </template>
                <p-order-create-row :invoiceId="invoiceId" />
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
import POrderCreateRow from "./POrderCreateRow";
import POrderRow from "./POrderRow";
import EventBus from "../../../eventBus";

export default {
    name: "p-orders-table",
    components: { POrderRow, POrderCreateRow },
    props: { items: null, invoiceId: null },

    data() {
        return {
            perPage: 10,
            currentPage: 1,
            orders: "",
        };
    },
    computed: {
        rows() {
            return this.orders.length;
        },
    },

    methods: {
        totalPrice(order) {
            return order.quantity * order.unit_price;
        },
        ivaOrder(order) {
            return this.totalPrice(order) * order.product_iva;
        },
        totalIva() {
            return this.orders.reduce(
                (sum, order) => sum + this.ivaOrder(order),
                0
            );
        },
        totalToPay() {
            return this.orders.reduce(
                (sum, order) => sum + this.totalPrice(order),
                0
            );
        },
        subTotal() {
            return this.totalToPay() - this.totalIva();
        },
        addOrder(order) {
            this.orders.push(order);
        },
        deleteOrder(order) {
            const index = _.findIndex(this.orders, { id: order.id });
            this.orders.splice(index, 1);
        },
    },
    created() {
        if (this.items) {
            this.orders = [...this.items];
        }
        EventBus.$on("create-order", (order) => this.addOrder(order));
        EventBus.$on("delete-order", (order) => this.deleteOrder(order));
    },
};
</script>
