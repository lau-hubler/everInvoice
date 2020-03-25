<template>
    <a class="btn btn-link text-secondary" @click="showItem()">
        <slot/>
    </a>
</template>

<script>
import EventBus from '../../eventBus'
    export default {
        props: {
            action: {
                type: String
            },
            item: Object,
            component: String,
            footer: String
        },
        data () {
            return {
                title: 'Updating',
            }
        },
        methods: {
            show() {
                alert(this.item)
            },
            showItem() {
                EventBus.$emit('show-item', {
                    component: this.component,
                    footer: this.footer,
                    props: {
                      action: this.action + "/" + this.item.id,
                      item: this.item,
                    }
                });
            },
        },
    }
</script>
