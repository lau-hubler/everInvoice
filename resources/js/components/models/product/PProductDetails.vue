<template>
    <div>
        <b-container>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("product.code.label") }}
                </b-col>
                <b-col>{{ item.code }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("product.name.label") }}
                </b-col>
                <b-col>{{ item.name }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("product.description.label") }}
                </b-col>
                <b-col>{{ item.description }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("product.price.label") }}
                </b-col>
                <b-col>{{ item.price | money }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("product.category.label") }}
                </b-col>
                <b-col>{{ item.category.name }}</b-col>
            </b-row>
            <b-row class="p-1">
                <b-col class="text-right font-weight-bold" cols="4">
                    {{ trans("category.iva.label") }}
                </b-col>
                <b-col>{{ item.category.iva | percentage }}</b-col>
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
    name: "PProductDetails",

    props: {
        item: null,
    },
};
</script>
