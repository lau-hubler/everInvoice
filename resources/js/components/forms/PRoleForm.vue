<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form ref="form" v-bind="$attrs" @submit.prevent="validate().then(onSubmit)">
            <b-row>
                <input :value="CSRFToken" type="hidden" name="_token" />
                <b-col cols="3">
                    <p-text-input
                        rules="required|min:3"
                        type="text"
                        :label="trans('category.name.label')"
                        label-cols-sm="3"
                        name="name"
                        v-model="role.name"
                        :placeholder="trans('role.name.placeholder')"
                    />
                </b-col>
                <b-col>
                    <p-text-input
                        rules="required|min:5"
                        type="text"
                        :label="trans('category.description.label')"
                        label-cols-sm="2"
                        name="description"
                        v-model="role.description"
                        :placeholder="trans('role.description.placeholder')"
                    />
                </b-col>
            </b-row>
            <b-row>
                <h5 class="text-gray-700 ml-5 mt-2 pl-5">Permissions:</h5>
            </b-row>
            <b-row class="mt-2">
                <b-col cols="2" class="font-weight-bold text-right">{{ trans('invoice.title')}}:</b-col>
                <b-col>
                    <b-form-checkbox-group
                        id="invoicePermissions"
                        v-model="selected"
                        :options="invoicePermissions"
                    ></b-form-checkbox-group>
                </b-col>
            </b-row>
            <b-row class="mt-2">
                <b-col cols="2" class="font-weight-bold text-right">{{ trans('stakeholder.title')}}:</b-col>
                <b-col>
                    <b-form-checkbox-group
                        id="stakeholderPermissions"
                        v-model="selected"
                        :options="stakeholderPermissions"
                    ></b-form-checkbox-group>
                </b-col>
            </b-row>
            <b-row class="mt-2">
                <b-col cols="2" class="font-weight-bold text-right">{{ trans('product.title')}}:</b-col>
                <b-col>
                    <b-form-checkbox-group
                        id="productPermissions"
                        v-model="selected"
                        :options="productPermissions"
                    ></b-form-checkbox-group>
                </b-col>
            </b-row>
            <b-row class="mt-2">
                <b-col cols="2" class="font-weight-bold text-right">{{ trans('category.title')}}:</b-col>
                <b-col>
                    <b-form-checkbox-group
                        id="categoryPermissions"
                        v-model="selected"
                        :options="categoryPermissions"
                    ></b-form-checkbox-group>
                </b-col>
            </b-row>
            <b-row class="mt-2">
                <b-col cols="2" class="font-weight-bold text-right">Order:</b-col>
                <b-col>
                    <b-form-checkbox-group
                        id="orderPermissions"
                        v-model="selected"
                        :options="orderPermissions"
                    ></b-form-checkbox-group>
                </b-col>
            </b-row>
            <b-row class="mt-2">
                <b-col cols="2" class="font-weight-bold text-right">Role:</b-col>
                <b-col>
                    <b-form-checkbox-group
                        id="rolePermissions"
                        v-model="selected"
                        :options="rolePermissions"
                    ></b-form-checkbox-group>
                </b-col>
            </b-row>
            <input type="hidden" name="selected" :value="JSON.stringify(selected)">
            <b-row class="justify-content-end mx-5">
                <b-button type="submit" variant="primary">Submit</b-button>
            </b-row>
        </b-form>
    </ValidationObserver>
</template>

<script>
import PTextInput from "../inputs/PTextInput";
import { ValidationObserver } from "vee-validate";

export default {
    name: "PRoleForm",

    components: { PTextInput, ValidationObserver },

    props: { value: null },

    data: () => ({
        role: "",
        CSRFToken: document.head.querySelector("[name=csrf-token][content]")
            .content,
        selected: [],
        invoicePermissions: [
            { text: 'list', value: 'invoice.index' },
            { text: 'create', value: 'invoice.store' },
            { text: 'edit', value: 'invoice.update' },
            { text: 'details', value: 'invoice.show' },
            { text: 'delete', value: 'invoice.delete' },
            { text: 'import', value: 'invoice.import' },
            { text: 'export', value: 'invoice.export' },
        ],
        stakeholderPermissions: [
            { text: 'list', value: 'stakeholder.index' },
            { text: 'create', value: 'stakeholder.store' },
            { text: 'edit', value: 'stakeholder.update' },
            { text: 'details', value: 'stakeholder.show' },
            { text: 'delete', value: 'stakeholder.delete' },
        ],
        productPermissions: [
            { text: 'list', value: 'product.index' },
            { text: 'create', value: 'product.store' },
            { text: 'edit', value: 'product.update' },
            { text: 'details', value: 'product.show' },
            { text: 'delete', value: 'product.delete' },
        ],
        categoryPermissions: [
            { text: 'list', value: 'category.index' },
            { text: 'create', value: 'category.store' },
            { text: 'edit', value: 'category.update' },
            { text: 'details', value: 'category.show' },
            { text: 'delete', value: 'category.delete' },
        ],
        orderPermissions: [
            { text: 'list', value: 'order.index' },
            { text: 'create', value: 'order.store' },
            { text: 'edit', value: 'order.update' },
            { text: 'details', value: 'order.show' },
            { text: 'delete', value: 'order.delete' },
        ],
        rolePermissions: [
            { text: 'list', value: 'role.index' },
            { text: 'create', value: 'role.store' },
            { text: 'edit', value: 'role.update' },
            { text: 'details', value: 'role.show' },
            { text: 'delete', value: 'role.delete' },
        ],
    }),

    watch: {
        role(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.role = newVal;
        },
    },

    methods: {
        onSubmit() {
            this.$refs.form.submit();
        }
    },

    created() {
        if (this.value) {
            this.role = this.value;
        }
    },
};
</script>
