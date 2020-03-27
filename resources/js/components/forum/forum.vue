<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <h1 class="grey--text">Questions</h1>
      </v-col>
      <v-col cols="8">
        <v-skeleton-loader
          v-if="visible"
          ref="skeleton"
          v-for="n in 4"
          :key="n"
          class="mx-auto mb-5"
          type="list-item-avatar-three-line"

        ></v-skeleton-loader>
        <questions v-for="(da,index) in data" :key="da.index" :data="da"></questions>
      </v-col>

      <v-col cols="4">
        <sidebar></sidebar>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import questions from "./questions";
import sidebar from "./sidebar";
export default {
  data() {
    return {
      data: {},
      visible: true,

    };
  },
  created() {
    axios
      .get("api/question")
      .then(res => {
        this.data = res.data.data;
        this.visible = false;
      })
      .catch(error => console.log(error));
  },
  components: {
    questions,
    sidebar
  }
};
</script>

<style>
</style>
