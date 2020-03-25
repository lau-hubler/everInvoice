<template>
    <div>
        <b-container>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">ID:</b-col>
                <b-col>{{ category.id }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">{{ trans('category.name.label') }}</b-col>
                <b-col>{{ category.name }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">{{ trans('category.description.label') }}</b-col>
                <b-col>{{ category.description }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">{{ trans('category.iva.label') }}</b-col>
                <b-col>{{ category.iva | percentage }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">{{ trans('category.createdAt') }}:</b-col>
                <b-col>{{ category.created_at | dateTime }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">{{ trans('category.updatedAt') }}:</b-col>
                <b-col>{{ category.updated_at | dateTime }}</b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    export default {
        name: "PCategoryDetails",

        props: {
            category: Object
        },
    };
</script>
