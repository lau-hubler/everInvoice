<template>
    <ValidationObserver ref="observer">
        <input :value="CSRFToken" type="hidden" name="_token" />
        <p-text-input
            rules="required|min:3"
            type="text"
            :label="trans('stakeholder.name.label')"
            label-cols-sm="3"
            name="name"
            v-model="person.name"
            :placeholder="trans('stakeholder.name.placeholder')"
        />
        <p-text-input
            rules="required_if:tabIndex,0|min:3"
            type="text"
            :label="trans('stakeholder.surname.label')"
            label-cols-sm="3"
            name="surname"
            v-model="person.surname"
            :placeholder="trans('stakeholder.surname.placeholder')"
        />
        <b-form-row>
            <b-col cols="3" class="font-weight-bold text-right">
                {{ trans('stakeholder.document.label')}}
            </b-col>
            <b-col cols="2">
                <p-select-input
                    rules="required"
                    :options="prepareOptions()"
                    name="document_type_id"
                    v-model="person.document_type_id"
                    :placeholder="trans('stakeholder.document_type.placeholder')"
                />
            </b-col>
            <b-col>
                <p-text-input
                    rules="required|min:5|unique"
                    type="text"
                    name="document"
                    v-model="person.document"
                    :placeholder="trans('stakeholder.document.placeholder')"
                />
            </b-col>
        </b-form-row>
        <p-text-input
            rules="required|email"
            type="email"
            :label="trans('stakeholder.email.label')"
            label-cols-sm="3"
            name="email"
            v-model="person.email"
            :placeholder="trans('stakeholder.email.placeholder')"
        />
        <p-text-input
            type="text"
            :label="trans('stakeholder.mobile.label')"
            label-cols-sm="3"
            name="mobile"
            v-model="person.mobile"
            :placeholder="trans('stakeholder.mobile.placeholder')"
        />
    </ValidationObserver>
</template>

<script>
import PTextInput from "../inputs/PTextInput";
import { ValidationObserver, Validator } from "vee-validate";
import numeral from "numeral";

export default {
    name: "PPersonForm",

    components: { PTextInput, ValidationObserver },

    props: {
        value: null,
        id: null,
        tabIndex: null,
    },

    data: () => ({
        person: "",
        stakeholders: null,
        CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
        documentTypes: {},
    }),

    watch: {
        person(newVal) {
            this.$emit("input", newVal);
        },

        value(newVal) {
            this.person = newVal;
        },
    },

    methods: {
        prepareOptions() {
            return this.documentTypes.map(function(document_type) {
                return {
                    value: document_type.id,
                    text: `${document_type.acronym} - ${document_type.name}`
                }
            });
        },
        sameDocument(original, value) {
            return original.document_type_id === this.person.document_type_id && original.document === value
        },
        isNotInDatabase(value) {
            return _.findIndex(this.stakeholders, { document: value, document_type_id: this.person.document_type_id }) === -1
        }
    },

    created() {
        if (this.value) {
            this.person = this.value;
        }
        axios.get("/stakeholders").then((response) => {
            this.stakeholders = response.data;
        });
        axios.get("/documentTypes").then((response) => {
            this.documentTypes = response.data;
        })
    },
    mounted() {
        const isUnique = (value) =>
            new Promise((resolve) => {
                setTimeout(() => {
                    let original = {document:null, document_type_id:null};
                    if(this.id){
                        original =_.find(this.stakeholders, { id: this.id})
                    }
                    if (this.isNotInDatabase(value) || this.sameDocument(original, value)) {
                        return resolve({
                            valid: true,
                        });
                    }

                    return resolve({
                        valid: false,
                        data: {
                            message: `This document already exists in our database.`,
                        },
                    });
                }, 200);
            });

        Validator.extend("unique", {
            validate: isUnique,
            getMessage: (field, params, data) => data.message,
        });
    },
};
</script>
