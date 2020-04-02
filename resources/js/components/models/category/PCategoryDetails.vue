<template>
    <div>
        <b-container>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("category.code.label") }}
                </b-col>
                <b-col>{{ item.code }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("category.name.label") }}
                </b-col>
                <b-col>{{ item.name }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("category.description.label") }}
                </b-col>
                <b-col>{{ item.description }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("category.iva.label") }}
                </b-col>
                <b-col>{{ item.iva | percentage }}</b-col>
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
    name: "PCategoryDetails",

    props: {
        item: null,
    },
};
</script>
