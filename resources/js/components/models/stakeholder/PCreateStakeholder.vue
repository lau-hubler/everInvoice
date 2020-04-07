<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <b-tabs v-model="tabIndex">
                <b-tab :title="trans('stakeholder.person.title')" active>
                    <p class="m-3">{{ trans("stakeholder.person.message") }}</p>
                    <p-person-form
                        v-model="item"
                        :tabIndex="tabIndex"
                    ></p-person-form>
                </b-tab>
                <b-tab :title="trans('stakeholder.company.title')">
                    <p class="m-3">
                        {{ trans("stakeholder.company.message") }}
                    </p>
                    <p-company-form
                        v-model="item"
                        :tabIndex="tabIndex"
                    ></p-company-form>
                </b-tab>
                <b-button hidden ref="submit-btn" type="submit" />
            </b-tabs>
        </b-form>
    </ValidationObserver>
</template>

<script>
import PStakeholderForm from "../../forms/PPersonForm";
import EventBus from "../../../eventBus";
import { ValidationObserver } from "vee-validate";
import api from "../../../api";

export default {
    name: "PCreateStakeholder",

    components: { PStakeholderForm, ValidationObserver },

    data: () => ({
        item: {
            name: "",
            surname: "",
            company: "",
            is_company: 0,
            document_type_id: "",
            document: "",
            email: "",
            mobile: "",
        },
        tabIndex: 0,
    }),

    created() {
        EventBus.$on("create", this.submitForm);
    },

    methods: {
        onSubmit() {
            const params = {
                name: this.item.name,
                surname: this.item.surname,
                company: this.item.company,
                is_company: this.isCompany(),
                document_type_id: this.item.document_type_id,
                document: this.item.document,
                email: this.item.email,
                mobile: this.item.mobile,
            };

            api.createItem("stakeholder", params).then((stakeholder) => {
                EventBus.$emit("new-stakeholder", stakeholder);
                EventBus.$emit("saved");
            });
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },

        isCompany() {
            if (this.tabIndex) {
                this.item.is_company = 1;
            }
            return this.item.is_company;
        },
    },
};
</script>
