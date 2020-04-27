<template>
    <b-button class="btn btn-warning" size="sm" :href="route">
        Pay now
    </b-button>
</template>

<script>
    export default {
        name: "PPayButton",

        props: {id: null},

        computed: {
            route() {
                return `/invoices/${this.id}/pay`
            },
        },


    }
</script>
