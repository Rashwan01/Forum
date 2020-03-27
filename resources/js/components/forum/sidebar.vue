<template>
  <v-card class="mx-auto" max-width="300" tile>
    <v-list disabled>
      <v-subheader>Categories</v-subheader>

      <v-list-item-group v-model="categories" color="primary">
        <v-skeleton-loader
          v-if="visible"
          ref="skeleton"
          v-for="n in 3"
          :key="n"
          class="my-5 mx-10"
          type="list-item-two-line"
        ></v-skeleton-loader>
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
      categories: {},
      visible: true
    };
  },
  created() {
    axios.get("api/category").then(res => {
      this.categories = res.data;
      this.visible = false;
    });
  }
};
</script>

<style  scoped>
</style>
