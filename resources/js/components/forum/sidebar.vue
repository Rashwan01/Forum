<template>
  <v-card class="mx-auto" max-width="300" tile>
    <v-list disabled>
      <v-subheader>Categories</v-subheader>
      <v-list-item-group v-model="categories" color="primary">
        <v-list-item v-for="(category, i) in categories" :key="i">
          <v-list-item-content>
            <v-list-item-title v-text="category.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      categories: {}
    };
  },
  created(){
 axios.get("api/category")
    .then(res=>{

      this.categories = res.data
    })
  }
};
</script>

<style  scoped>
</style>
