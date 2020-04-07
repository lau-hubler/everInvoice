<template>
    <div class="m-3">
        <div class="p-3 px-3 bg-secondary text-white border rounded-top d-flex justify-content-between align-items-end">
            <h6 class="mb-0 h3">{{ trans("product.title") }}</h6>
            <b-button-group class="mx-1">
                <p-search-input size="md" item="order"></p-search-input>
            </b-button-group>
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
                <template v-for="order in filteredOrders">
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
import _ from "lodash";

export default {
    name: "p-orders-table",
    components: { POrderRow, POrderCreateRow },
    props: { items: null, invoiceId: null },

    data() {
        return {
            orders: "",
            filters: [],
        };
    },
    computed: {
        filteredOrders() {
            let filtered = [];
            let orders = this.orders;

            if (this.filterEmpty()) {
                return orders;
            }
            filtered = this.filterORTags(filtered, orders);
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

        filterEmpty() {
            return (
                this.filters &&
                this.filters.constructor === Array &&
                this.filters.length === 0
            );
        },
        filterORTags(filtered, orders) {
            let eachFilter = (order, filter) =>
                this.eachFilter(order, filter);

            this.ORTags.forEach(function (filter) {
                orders
                    .filter((order) => eachFilter(order, filter))
                    .map((order) => {
                        if (filtered.includes(order) === false)
                            filtered.push(order);
                    });
            });
            return filtered;
        },
        filterANDTags(orders) {
            let filtered = orders;
            let eachFilter = (order, filter) =>
                this.eachFilter(order, filter);

            this.ANDTags.forEach(function (filter) {
                filtered = filtered.filter((order) =>
                    eachFilter(order, filter)
                );
            });
            return filtered;
        },
        eachFilter(order, filter) {
            return (
                this.filterProductName(order,filter) ||
                this.filterProductCode(order,filter)
            );
        },
        filterProductName(order, filter) {
            return order.product.name.toLowerCase()
                .includes(filter.toLowerCase());
        },
        filterProductCode(order, filter) {
            return order.product.code.includes(filter.toUpperCase());
        },
    },
    created() {
        if (this.items) {
            this.orders = [...this.items];
        }
        EventBus.$on("create-order", (order) => this.addOrder(order));
        EventBus.$on("delete-order", (order) => this.deleteOrder(order));
        EventBus.$on("search-order", (filters) => (this.filters = filters));
    },
};
</script>
