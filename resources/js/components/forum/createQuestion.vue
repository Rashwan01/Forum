<template>
  <v-container>
    <v-row>
      <v-col cols="6" class="mx-auto mb-10">
        <form>
          <v-text-field v-model="form.title" label="title" required></v-text-field>
          <p class="red--text" v-if="errors.title">please Enter The Question name</p>
          <vue-simplemde v-model="form.body" ref="markdownEditor" />
          <p class="red--text" v-if="errors.body">please Enter More Details about question</p>

          <v-select
            v-model="form.category_id"
            :items="categories"
            item-value="id"
            item-text="name"
            label="Select Category"
            required
          ></v-select>
          <p class="red--text" v-if="errors.category_id">please Enter More Details about question</p>

          <v-btn color="primary" class="mr-4" @click="submit" :disabled="disabled">Creat question</v-btn>
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      form: {
        title: null,
        body: null,
        category_id: null
      },
      categories: {},
      errors: {}
    };
  },
  computed: {
    disabled() {
     return !(this.form.title && this.form.body && this.form.category_id);
    }
  },
  created() {
    axios.get("api/category").then(res => {
      this.categories = res.data;
    });
  },
  methods: {
    submit() {
      axios
        .post("/api/question", this.form)
        .then(res => this.$router.push(res.data.path))
        .catch(error => this.errors = error.response.data.errors);
    }
  }
};
</script>
<style>
</style>
