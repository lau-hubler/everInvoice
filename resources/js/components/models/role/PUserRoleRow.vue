<template>
    <b-tr>
        <b-td>{{ user.name }} {{ user.surname }}</b-td>
        <b-td>{{ user.email }}</b-td>
        <b-td>
            <ValidationObserver ref="observer" v-slot="{ validate }">
                <b-form
                    ref="form"
                    v-bind="$attrs"
                    @submit.prevent="validate().then(onSubmit)"
                >
                    <input :value="CSRFToken" type="hidden" name="_token" />
                    <p-select-input
                        v-if="editMode"
                        rules="required"
                        :options="prepareOptions()"
                        name="role"
                        v-model="selected"
                    />
                    <input type="hidden" name="role" :value="selected" />
                    <b-button hidden ref="submit-btn" type="submit" />
                </b-form>
            </ValidationObserver>
            <span v-if="!editMode">{{ user.role.name }}</span>
        </b-td>
        <b-td>{{ user.updated_at | dateTime }}</b-td>
        <b-td>
            <a
                class="btn-link"
                :class="editMode ? 'text-success' : 'text-primary'"
            >
                <font-awesome-icon icon="save" @click="save" v-if="editMode" />
                <font-awesome-icon v-else icon="edit" @click="toggleEditMode" />
            </a>
            <a class="btn btn-link text-secondary" v-if="editMode">
                <font-awesome-icon icon="times" @click="toggleEditMode" />
            </a>
        </b-td>
    </b-tr>
</template>

<script>
import { ValidationObserver } from "vee-validate";

export default {
    name: "PUserRoleRow",

    components: { ValidationObserver },

    props: { u: null, stringifyRoles: null },

    data() {
        return {
            user: null,
            roles: null,
            selected: null,
            editMode: false,
            permissions: [],
            CSRFToken: document.head.querySelector("[name=csrf-token][content]")
                .content,
        };
    },

    methods: {
        toggleEditMode() {
            this.editMode = !this.editMode;
        },
        save() {
            this.$refs["submit-btn"].click();
            this.toggleEditMode();
        },
        can(permission) {
            if (this.permissions.includes("superAdmin")) return true;

            return this.permissions.includes(permission);
        },
        onSubmit() {
            this.$refs.form.submit();
        },
        prepareOptions() {
            return this.roles.map(function (role) {
                return {
                    value: role.id,
                    text: role.name,
                };
            });
        },
    },

    created() {
        this.user = JSON.parse(this.u);
        this.roles = JSON.parse(this.stringifyRoles);
        this.selected = this.user.role.id;
    },
};
</script>
