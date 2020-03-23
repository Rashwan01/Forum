<template>
  <v-container>
    <v-row>
      <v-col cols="6" class="mx-auto mb-10">
        <form>
          <v-text-field
          v-model="form.title"
          label="title"
          required
          ></v-text-field>
          <vue-simplemde v-model="form.body" ref="markdownEditor" />
          <v-select
          v-model="form.category_id"
          :items="categories"
          item-value="id"
          item-text="name"
          label="category"
          required
          ></v-select>


          <v-btn color="primary" class="mr-4" @click="submit">Creat question</v-btn>

        </form>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default{
  data(){
    return{
      form:{
        title:null,
        body:null,
        category_id:null

      },
      categories:{},
      errors:{

      }
    }
  },
  created(){
    axios.get("api/category")
    .then(res=>{
      
      this.categories = res.data
    })
  },
  methods:{
    submit(){
      axios.post("/api/question",this.form)
      .then(res=>this.$router.push(res.data.path))
      .catch(error=>console.log(error.response.data.error));
    }
  }

}
</script>
<style>

</style>
