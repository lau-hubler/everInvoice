<template>
  <p-modal :isOpen="!!component" :title="title" @onClose="handleClose">
    <component :is="component" @onClose="handleClose" v-bind="props" />
  </p-modal>
</template>

<script>
import EventBus from '../eventBus'
import PModal from '../components/PModal'
export default {
  data () {
    return {
      component: null,
      title: null,
      props: null
    }
  },
  created () {
    EventBus.$on('open', ({ component, title = '', props = null }) => {
      this.component = component
      this.title = title
      this.props = props
    })
    document.addEventListener('keyup', this.handleKeyup)
  },
  beforeDestroy () {
    document.removeEventListener('keyup', this.handleKeyup)
  },
  methods: {
    handleClose () {
      this.component = null
    },
    handleKeyup (e) {
      if (e.keyCode === 27) this.handleClose()
    }
  },
  components: { PModal },
}
</script>