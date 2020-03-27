<template>
  <div>
    <edit-question :data="data" v-if="editMode"></edit-question>
    <v-card class="mt-4" v-else-if="itsOk && ! editMode">
      <v-card-title v-text="data.title"></v-card-title>
      <v-card-subtitle>{{data.create_at}}</v-card-subtitle>
      <v-card-text v-text="data.body"></v-card-text>
      <v-card-actions v-if="IsOwnToAuthUser()">
        <v-btn color="success" @click="edit">edit</v-btn>

        <v-btn color="danger" @click="destroy">Delete</v-btn>
      </v-card-actions>
    </v-card>
    <v-row>
      <v-col cols="6" v-for="n in 4" :key="n">
        <v-skeleton-loader v-if="visible" ref="skeleton" class="my-5 mx-10" type="card"></v-skeleton-loader>
      </v-col>
    </v-row>

    <replies :questionSlug="data.slug" :replies="data.replies"></replies>
    <add-reply v-if="userIsLogin" :questionSlug="data.slug"></add-reply>
    <div class="mt-4 text-center" v-else>
      <router-link :to="{name:'login'}">login to to reply</router-link>
    </div>
  </div>
</template>

<script>
import editQuestion from "./editQuestion";
import replies from "./replies";
import addReply from "./reply";

export default {
  data() {
    return {
      data: {},
      itsOk: false,
      editMode: false,
      visible: true
    };
  },
  created() {
    this.cancel();
    axios
      .get(`/api/question/${this.$route.params.slug}`)
      .then(res => {
        (this.data = res.data.data), (this.itsOk = true);
        this.visible = false;
      })
      .catch(error => console.log(error));
  },
  computed: {
    body() {
      return md.parse(this.data.body);
    },
    userIsLogin() {
      return User.isLogin();
    }
  },
  methods: {
    IsOwnToAuthUser() {
      return User.own(this.data.user_id);
    },

    destroy() {
      axios
        .delete(`/api/question/${this.data.slug}`)
        .then(res => {
          this.$router.push({ name: "forum" });
        })
        .catch(error => console.log(error.response.data));
    },
    edit() {
      this.editMode = true;
    },
    cancel() {
      EventBus.$on("cancel", () => {
        this.editMode = false;
      });
    }
  },
  components: { editQuestion, replies, addReply }
};
</script>

<style>
</style>
