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
        <template v-slot:cell(actions)="row">
            <div class="btn-group btn-group-sm" role="group">
                <a class="btn btn-link text-secondary" @click="show(row.item)">
                    <font-awesome-icon icon="eye" />
                </a>
                <a href="#" class="btn btn-link" @click="info(row.item, row.index, $event.target)">
                    <font-awesome-icon icon="edit" />
                </a>
                <a href="#" class="btn btn-link text-danger">
                    <font-awesome-icon icon="trash" />
                </a>
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
    <p-modal-root />
  </div>
</template>

<script>
import EventBus from '../../eventBus'
import PModalRoot from '../PModalRoot'
import PShowCategory from '../PShowCategory';

export default {
    name:"PCategoriesTable",

    components: { PModalRoot },

    props: {
        name: {
            type: String,
            default: "Name"
        },
        description: {
            type: String,
            default: "Description"
        },
        updated_at: {
            type: String,
            default: "Updated at"
        },
    },

    data() {
        return {
            categories: [],
            perPage: 10,
            currentPage: 1,
            emptyTable: "There are no categories to show",
            fields: [
                {
                    key: 'id',
                    label: 'ID',
                    sortable: true
                },
                {
                    key: 'name',
                    label: this.name,
                    sortable: true
                },
                {
                    key: 'description',
                    label: this.description
                },
                {
                    key: 'iva',
                    label: 'IVA',
                    sortable: true,
                },
                {
                    key: 'updated_at',
                    label: this.updated_at,
                    sortable: true
                },
                {
                    key: 'actions',
                    label: ""
                }
            ]
        }
    },

    computed: {
        rows() {
            return this.categories.length
        }
    },

    methods: {
        show(item) {
            EventBus.$emit('open', {
                component: "p-show-category",
                title: 'Showing category',
                props: { category: item }
            })
        }
    },

    mounted() {
        axios.get('/categories').then(response =>
        this.categories = response.data)
    }
}
</script>
