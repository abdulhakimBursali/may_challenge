<script>
import { isProxy, toRaw } from 'vue'

export default {
  data() {
    return {
      categories: [],
      error: null
    }
  },
  created() {
    this.$watch(() => this.$route.params.id, this.fetchCategories, { immediate: true })
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await fetch('http://localhost:3002/api/category')
        const data = await response.json()
        this.categories = data.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      }
    }
  }
}
</script>

<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul
          class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
          style="--bs-scroll-height: 100px"
        >
          <li class="nav-item">
            <RouterLink class="nav-link" to="/">Anasayfa</RouterLink>
          </li>
          <li class="nav-item" v-for="(category, index) in categories" :key="index">
            <RouterLink class="nav-link" :to="{ name: 'category', params: { id: category.id } }">{{
              category.name
            }}</RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<style scoped></style>
