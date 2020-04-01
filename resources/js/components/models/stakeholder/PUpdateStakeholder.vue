<template>
    <ValidationObserver ref="observer" v-slot="{ validate }">
        <b-form @submit.prevent="validate().then(onSubmit)">
            <p-company-form v-if="item.is_company" v-model="item" :id="id"></p-company-form>
            <p-person-form v-else v-model="item" :id="id"></p-person-form>
            <b-button hidden ref="submit-btn" type="submit" />
        </b-form>
    </ValidationObserver>
</template>

<script>
import EventBus from "../../../eventBus";
import { ValidationObserver } from "vee-validate";

export default {
    name: "PUpdatePerson",
    components: { ValidationObserver },

    props: {
        action: String,
        id: Number,
    },

    data() {
        return {
            item: null,
            original: null,
        };
    },

    created() {
        axios.get(this.route(this.id)).then((response) => {
            this.item = response.data;
            this.original = { ...this.item };
        });
        EventBus.$on("save", this.submitForm);
    },

    methods: {
        onSubmit() {
            if (!_.isEqual(this.original, this.item)) {
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
                axios.put(this.route(this.id), params).then((response) => {
                    const stakeholder = response.data;
                    EventBus.$emit("update-stakeholder", stakeholder);
                });
            }
            EventBus.$emit("saved");
        },

        submitForm() {
            this.$refs["submit-btn"].click();
        },

        route(id) {
            return `${this.action}/${id}`;
        },

        isCompany() {
            if(this.tabIndex) {
                this.item.is_company = 1
            }
            return this.item.is_company
        }
    },
};
</script>
