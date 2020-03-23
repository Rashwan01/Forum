<template>
  <router-link :to="data.path">

    <v-card class="mt-4" dark >
      <v-card-title>{{data.title}}</v-card-title>
      <v-card-subtitle>{{data.user}} {{data.create_at}}</v-card-subtitle>
      <v-card-text>{{data.body}}</v-card-text>
    </v-card>
  </router-link>

</template>
<script >
export default{
  props:["data"]
}

</script>
<style>
.v-application a {
  text-decoration: none;
}
</style>
