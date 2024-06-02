<script>
import { isProxy, toRaw } from 'vue'

export default {
  data() {
    return {
      products: [],
      error: null
    }
  },
  created() {
    this.$watch(() => this.$route.params.id, this.fetchProducts, { immediate: true })
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch(
          'http://localhost:3002/api/category/' + this.$route.params.id + '/products'
        )
        const data = await response.json()
        this.products = data.data
        console.log(this.products)
      } catch (error) {
        console.error('Error fetching products:', error)
      }
    }
  }
}
</script>

<template>
  <div class="container-fluid d-flex flex-wrap justify-content-between pt-2">
    <div class="card col-3 mx-2 my-2" v-for="(product, index) in products" :key="index">
      <img class="card-img-top" :src="product.image_url" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">{{ product.name }}</h5>
        <p class="card-text">
          {{ product.description }}
        </p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
