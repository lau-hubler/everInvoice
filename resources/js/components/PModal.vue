<template>
  <div class="modal-backdrop"
    v-show="isOpen"
    :class="{open: isOpen}"
    @click="$emit('onClose')">

    <div class="modal-dialog" :class="{open: isOpen}" @click.stop>
      <b-card>
        <b-card-title>{{ title }}</b-card-title>
        <b-card-text><slot /></b-card-text>
      </b-card>
    </div>

  </div>
</template>

<script>
export default {
  name: "PModal",
  
  props: {
    isOpen: Boolean,
    title: String,
  }
}
</script>

<style scoped>
.modal-backdrop {
  background: rgba(83, 83, 83, 0.8);
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  opacity: 1;
}
.modal-dialog {
  width: 30rem;
  background: rgb(255, 255, 255);
  padding: 2rem 2rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  border-radius: 0.3rem;
}
</style>