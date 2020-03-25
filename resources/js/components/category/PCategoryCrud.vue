<template>
    <div>
        <p-category-form  v-if="editMode"></p-category-form>
        <p-category-details v-else :category="item"></p-category-details>
    </div>
</template>

<script>
    import PCategoryDetails from "./PCategoryDetails";
    import PCategoryForm from "../forms/PCategoryForm"
    import EventBus from "../../eventBus";

    export default {
        name:"PCategoryCrud",

        components:{ PCategoryDetails, PCategoryForm },

        props: {
            route: String,
            item: {
                type: Object,
                default: {
                    name:"",
                    description:"",
                    iva:""
                }
            },
        },

        data() {
            return {
                editMode: false,
            }
        },

        created () {
            EventBus.$on("edit", this.toggleEditMode)
        },

        methods: {
            toggleEditMode() {
                this.editMode = !this.editMode
            }
        }
    }
</script>
