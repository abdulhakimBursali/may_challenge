<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Categories from './components/Categories.vue'
</script>

<template>
  <div>
    <Categories />
  </div>

  <RouterView />
</template>

<style scoped>

</style>
