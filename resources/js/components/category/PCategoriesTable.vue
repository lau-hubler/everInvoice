<template>
    <div class="overflow-auto">
        <b-table
            id="categories-table"
            :items="categories"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            striped
            hover
            sort-icon-left
            no-border-collapse
            show-empty
            :empty-text="emptyTable"
            class="category-table"
        >
            <template v-slot:cell(iva)="data">
                {{ data.value | percentage }}
            </template>
            <template v-slot:cell(updated_at)="data">
                {{ data.value | dateTime }}
            </template>
            <template v-slot:cell(actions)="row">
                <div class="btn-group btn-group-sm" role="group">
                    <p-link-button
                        :id="row.item.id"
                        object="category"
                        component="p-category-details"
                        event="show-item"
                    >
                        <font-awesome-icon icon="eye" />
                    </p-link-button>
                    <p-link-button
                        :id="row.item.id"
                        component="p-update-category"
                        object="category"
                        event="edit-item"
                        variant="text-primary"
                    >
                        <font-awesome-icon icon="edit" />
                    </p-link-button>
                    <p-delete-button :item="row.item" :action="action">
                        <font-awesome-icon icon="trash" />
                    </p-delete-button>
                </div>
            </template>
        </b-table>
        <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            aria-controls="categories-table"
            first-number
            last-number
        ></b-pagination>
    </div>
</template>

<script>
import EventBus from "../../eventBus";

export default {
    name: "PCategoriesTable",

    props: {
        name: {
            type: String,
            default: "Name",
        },
        description: {
            type: String,
            default: "Description",
        },
        updated_at: {
            type: String,
            default: "Updated at",
        },
        action: String,
    },

    data() {
        return {
            categories: [],
            perPage: 10,
            currentPage: 1,
            emptyTable: "There are no categories to show",
            fields: [
                {
                    key: "id",
                    label: "ID",
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
                    key: "iva",
                    label: "IVA",
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
            return this.categories.length;
        },
    },

    methods: {
        addCategory(category) {
            this.categories.push(category);
        },
        deleteCategory(category) {
            const index = _.findIndex(this.categories, { id: category.id });
            this.$delete(this.categories, index, category);
        },
        updateCategory(category) {
            const index = _.findIndex(this.categories, { id: category.id });
            this.$set(this.categories, index, category);
        },
    },

    mounted() {
        axios
            .get(this.action)
            .then((response) => (this.categories = response.data));

        EventBus.$on("new-category", (category) => {
            this.addCategory(category);
        });

        EventBus.$on("update-category", (category) => {
            this.updateCategory(category);
        });

        EventBus.$on("delete-category", (category) => {
            this.deleteCategory(category);
        });
    },
};
</script>
