<template>
  <v-container>
    <v-row>
      <v-col cols="6" class="mx-auto mb-10">
        <form>
          <v-text-field v-model="form.name" label="category name" required></v-text-field>
          <v-btn color="primary" class="mr-4" @click="submit" v-if="!editSlug">Create category</v-btn>
          <v-btn color="primary" class="mr-4" @click="submit" v-else>update category</v-btn>
        </form>
      </v-col>
      <v-col cols="6"></v-col>
      <v-col cols="3" v-for="(category,i) in categories" :key="i">
        <v-card color="#385F73" dark>
          <v-card-title class="headline">{{category.name}}</v-card-title>

          <v-card-actions>
            <v-btn text @click="edit(i)">edit</v-btn>
            <v-btn @click="destroy(category.slug,i  )" text>delete</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: null
      },
      categories: {},
      editSlug: null
    };
  },
  created() {
      if(!User.isAdmin()){
 this.$router.push({name:forum})
      }
    axios.get("/api/category").then(res => {
      this.categories = res.data;
    });
    console.log(this.editSlug)
  },

  methods: {
    submit() {
        console.log(this.editSlug);
      this.editSlug == null ? this.create() : this.update();
    },
    create() {
      axios
        .post("/api/category", this.form)
        .then(res => {
          this.categories.unshift(res.data);
          this.form.name = null;
        })
        .catch(error => console.log(error));
    },
    update() {
      axios
        .patch(`/api/category/${this.editSlug}`, this.form)
        .then(res => {
          this.categories.unshift(res.data);
          this.form.name = null;
          this.editSlug = null;
        })
        .catch(error => console.log(error));
    },
    destroy(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then(res => {
          this.categories.splice(index, 1);
        })
        .catch(error => console.log(error));
    },
    edit(index) {
      this.form.name = this.categories[index].name,
        this.editSlug = this.categories[index].slug,
        this.categories.splice(index,1)
    }
  }
};
</script>
<style>
</style>
