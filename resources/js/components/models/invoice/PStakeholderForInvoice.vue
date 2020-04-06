<template>
    <div>
        <b-container>
            <b-row class="p-1">
                <span
                    v-if="item.is_company"
                    class="text-right font-weight-bold"
                >
                    {{ trans("stakeholder.name.labelCompany") }}
                </span>
                <span v-else class="text-right font-weight-bold">
                    {{ trans("stakeholder.name.labelPerson") }}
                </span>
                <b-col>{{ item.name }} {{item.surname}}</b-col>
            </b-row>
            <b-row v-if="item.is_company" class="p-1">
                <span class="text-right font-weight-bold">
                    {{ trans("stakeholder.company.label") }}
                </span>
                <b-col>{{ item.company }}</b-col>
            </b-row>

            <b-row class="p-1">
                <span class="text-right font-weight-bold">
                    {{ trans("stakeholder.document.label") }}
                </span>
                <b-col
                    >{{ item.document_type.acronym }} {{ item.document }}</b-col
                >
            </b-row>
            <b-row class="p-1">
                <span class="text-right font-weight-bold">
                    {{ trans("stakeholder.email.label") }}
                </span>
                <b-col>{{ item.email }}</b-col>
            </b-row>
            <b-row class="p-1">
                <span class="text-right font-weight-bold">
                    {{ trans("stakeholder.mobile.label") }}
                </span>
                <b-col>{{ item.mobile }}</b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    name: "PStakeholderForInvoice",

    props: {
        item: null,
    },
};
</script>
