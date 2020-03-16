
<template>
  <div>
    <p><strong>ID:</strong> {{ category.id }}</p>
    <p><strong>Name:</strong> {{ category.name }}</p>
    <p><strong>Description:</strong> {{ category.description }}</p>
    <p><strong>IVA:</strong> {{ category.iva | percentage }}</p>
    <p><strong>Created at:</strong> {{ category.created_at }}</p>
    <p><strong>Updated at:</strong> {{ category.updated_at }}</p>
  </div>
</template>

<script>
export default {
  props: {
    category: Object
  },
}
</script>