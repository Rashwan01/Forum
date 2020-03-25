<template>
  <v-container>
    <v-row class="mx-auto">
      <v-col col="4"></v-col>
      <v-col cols="4">
        <v-text-field
          label="add Reply"
          placeholder="Tap To Write"
          v-model="form.body"
          outlined
          dense
        ></v-text-field>
      </v-col>
      <v-col cols="4">
        <v-btn @click="submit">submit</v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      form: {
        body: null
      }
    };
  },
  methods: {
    submit() {
      axios.post(`/api/${this.questionSlug}/reply`, this.form).then(res => {
        EventBus.$emit("appendNewComment", res.data.reply);
        this.form.body = null;
      });
    }
  }
};
</script>
<style scoped>
</style>
