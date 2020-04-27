<template>
    <div class="overflow-auto">
        <b-table
            id="products-table"
            :items="products"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            striped
            hover
            sort-icon-left
            no-border-collapse
            show-empty
            :empty-text="emptyTable"
            class="product-table"
        >
            <template v-slot:cell(price)="data">
                {{ data.value | money }}
            </template>
            <template v-slot:cell(updated_at)="data">
                {{ data.value | dateTime }}
            </template>
            <template v-slot:cell(category)="data">
                {{ data.value.name }} ({{ data.value.iva | percentage }})
            </template>
            <template v-slot:cell(actions)="row">
                <div class="btn-group btn-group-sm" role="group">
                    <p-link-button
                        v-if="can('product.show')"
                        :id="row.item.id"
                        object="product"
                        component="p-product-details"
                        event="show-item"
                    >
                        <font-awesome-icon icon="eye" />
                    </p-link-button>
                    <p-link-button
                        v-if="can('product.store')"
                        :id="row.item.id"
                        component="p-update-product"
                        object="product"
                        event="edit-item"
                        variant="text-primary"
                    >
                        <font-awesome-icon icon="edit" />
                    </p-link-button>
                    <p-delete-button
                        v-if="can('product.delete')"
                        :item="row.item"
                        :action="action"
                        type="product"
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
            aria-controls="products-table"
            first-number
            last-number
        ></b-pagination>
    </div>
</template>

<script>
import EventBus from "../../../eventBus";
import api from "../../../api";
export default {
    name: "PProductsTable.vue",

    props: {
        code: {
            type: String,
            default: "Code",
        },
        name: {
            type: String,
            default: "Name",
        },
        description: {
            type: String,
            default: "Description",
        },
        price: {
            type: String,
            default: "Price",
        },
        category: {
            type: String,
            default: "Category",
        },
        updated_at: {
            type: String,
            default: "Updated at",
        },
        emptyMessage: {
            type: String,
            default: "There are no products to show",
        },
    },

    data() {
        return {
            products: [],
            permissions: [],
            perPage: 10,
            currentPage: 1,
            emptyTable: this.emptyMessage,
            fields: [
                {
                    key: "code",
                    label: this.code,
                    sortable: true,
                },
                {
                    key: "name",
                    label: this.name,
                    sortable: true,
                },
                {
                    key: "description",
                    label: this.description,
                },
                {
                    key: "price",
                    label: this.price,
                    sortable: true,
                },
                {
                    key: "category",
                    label: this.category,
                    sortable: true,
                },
                {
                    key: "updated_at",
                    label: this.updated_at,
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
            return this.products.length;
        },
    },

    methods: {
        addProduct(product) {
            this.products.push(product);
        },
        deleteProduct(product) {
            const index = _.findIndex(this.products, { id: product.id });
            this.$delete(this.products, index, product);
        },
        updateProduct(product) {
            const index = _.findIndex(this.products, { id: product.id });
            this.$set(this.products, index, product);
        },
        can(permission) {
            if (this.permissions.includes("superAdmin")) return true;

            return this.permissions.includes(permission);
        },
    },

    mounted() {
        api.getClassPaginated("product").then((products) => {
            this.products = products.data;
            this.currentPage = products.currentPage;
            this.perPage = products.perPage;
        });

        this.permissions = JSON.parse(
            window.document.querySelector('meta[name="permissions"]').content
        );

        EventBus.$on("new-product", (product) => {
            this.addProduct(product);
        });

        EventBus.$on("update-product", (product) => {
            this.updateProduct(product);
        });

        EventBus.$on("delete-product", (product) => {
            this.deleteProduct(product);
        });
    },
};
</script>

<style scoped></style>
