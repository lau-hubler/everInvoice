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
      sticky-header
      sort-icon-left
      no-border-collapse="true"
      show-empty
      :empty-text="emptyTable"
    >
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
    export default {
        name:"PCategoriesTable",

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
                        sortable: true
                    },
                    {
                        key: 'description'
                    },
                    {
                        key: 'iva',
                        label: 'IVA',
                        sortable: true,
                        formatter: value => {
                            return value*100
                        }
                    },
                    {
                        key: 'updated_at',
                        sortable: true
                    }
                ]
            }
        },

        computed: {
            rows() {
                return this.categories.length
            }
        },

        mounted() {
            axios.get('/categories').then(response =>
            this.categories = response.data)
        }
    }
</script>
