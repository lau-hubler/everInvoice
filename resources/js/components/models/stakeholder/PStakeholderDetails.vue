<template>
    <div>
        <b-container>
            <b-row class="p-1">
                <b-col
                    v-if="item.is_company"
                    class="text-right font-weight-bold"
                    cols="4"
                >
                    {{ trans("stakeholder.name.labelCompany") }}
                </b-col>
                <b-col v-else class="text-right font-weight-bold" cols="4">
                    {{ trans("stakeholder.name.labelPerson") }}
                </b-col>
                <b-col>{{ item.name }}</b-col>
            </b-row>
            <b-row v-if="item.is_company" class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("stakeholder.company.label") }}
                </b-col>
                <b-col>{{ item.company }}</b-col>
            </b-row>
            <b-row v-else class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("stakeholder.surname.label") }}
                </b-col>
                <b-col>{{ item.surname }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("stakeholder.document.label") }}
                </b-col>
                <b-col
                    >{{ item.document_type.acronym }} {{ item.document }}</b-col
                >
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("stakeholder.email.label") }}
                </b-col>
                <b-col>{{ item.email }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("stakeholder.mobile.label") }}
                </b-col>
                <b-col>{{ item.mobile }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("app.createdAt") }}:
                </b-col>
                <b-col>{{ item.created_at | dateTime }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("app.updatedAt") }}:
                </b-col>
                <b-col>{{ item.updated_at | dateTime }}</b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    name: "PStakeholderDetails",

    props: {
        item: null,
    },
};
</script>
