<template>
    <div class="overflow-auto">
        <b-table
            id="stakeholders-table"
            :items="stakeholders"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            striped
            hover
            sort-icon-left
            no-border-collapse
            show-empty
            :empty-text="emptyTable"
            class="stakeholder-table"
        >
            <template v-slot:cell(document)="data">
                {{ data.item.document_type.acronym }} {{ data.value }}
            </template>
            <template v-slot:cell(name)="data">
                {{ getName(data.item) }}
            </template>
            <template v-slot:cell(actions)="row">
                <div class="btn-group btn-group-sm" role="group">
                    <p-link-button
                        v-if="can('stakeholder.show')"
                        :id="row.item.id"
                        object="stakeholder"
                        component="p-stakeholder-details"
                        event="show-item"
                    >
                        <font-awesome-icon icon="eye" />
                    </p-link-button>
                    <p-link-button
                        v-if="can('stakeholder.update')"
                        :id="row.item.id"
                        component="p-update-stakeholder"
                        object="stakeholder"
                        event="edit-item"
                        variant="text-primary"
                    >
                        <font-awesome-icon icon="edit" />
                    </p-link-button>
                    <p-delete-button
                        v-if="can('stakeholder.delete')"
                        :item="row.item"
                        :action="action"
                        type="stakeholder"
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
            aria-controls="stakeholders-table"
            first-number
            last-number
        ></b-pagination>
    </div>
</template>

<script>
import EventBus from "../../../eventBus";
import api from "../../../api";

export default {
    name: "PStakeholdersTable",

    props: {
        document: {
            type: String,
            default: "Document",
        },
        name: {
            type: String,
            default: "Name",
        },
        email: {
            type: String,
            default: "E-mail",
        },
        mobile: {
            type: String,
            default: "Mobile",
        },
        emptyMessage: {
            type: String,
            default: "There are no stakeholders to show",
        },
    },

    data() {
        return {
            stakeholders: [],
            permissions: [],
            perPage: 10,
            currentPage: 1,
            emptyTable: this.emptyMessage,
            fields: [
                {
                    key: "document",
                    label: this.document,
                    sortable: true,
                },
                {
                    key: "name",
                    label: this.name,
                    sortable: true,
                },
                {
                    key: "email",
                    label: this.email,
                    sortable: true,
                },
                {
                    key: "mobile",
                    label: this.mobile,
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
            return this.stakeholders.length;
        },
    },

    methods: {
        addStakeholder(stakeholder) {
            this.stakeholders.push(stakeholder);
        },
        deleteStakeholder(stakeholder) {
            const index = _.findIndex(this.stakeholders, {
                id: stakeholder.id,
            });
            this.$delete(this.stakeholders, index, stakeholder);
        },
        updateStakeholder(stakeholder) {
            const index = _.findIndex(this.stakeholders, {
                id: stakeholder.id,
            });
            this.$set(this.stakeholders, index, stakeholder);
        },
        getName(stakeholder) {
            if (stakeholder.is_company) {
                return stakeholder.name;
            }
            return `${stakeholder.name} ${stakeholder.surname}`;
        },
        can(permission) {
            if (this.permissions.includes('superAdmin')) return true;

            return this.permissions.includes(permission);
        }
    },

    mounted() {
        api.getClassPaginated("stakeholder").then(
            (stakeholders) => {
                this.stakeholders = stakeholders.data
            }
        );

        this.permissions = JSON.parse(window.document.querySelector('meta[name="permissions"]').content);

        EventBus.$on("new-stakeholder", (stakeholder) => {
            this.addStakeholder(stakeholder);
        });

        EventBus.$on("update-stakeholder", (stakeholder) => {
            this.updateStakeholder(stakeholder);
        });

        EventBus.$on("delete-stakeholder", (stakeholder) => {
            this.deleteStakeholder(stakeholder);
        });
    },
};
</script>
