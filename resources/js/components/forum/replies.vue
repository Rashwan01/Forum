<template>
  <v-container>
    <v-row>

      <v-col cols="12" class="text-center">
        <h1 class="text-center">replies</h1>
      </v-col>

      <v-col cols="6" v-for="(reply, index) in replies" :key="index">
        <v-card class="mt-5" dark>
          <v-card-title>
            <v-icon large left>mdi-twitter</v-icon>
            <span class="title font-weight-light">Twitter</span>
            <v-spacer></v-spacer>
            <span>{{reply.create_at}}</span>
          </v-card-title>

          <v-card-text class="headline font-weight-bold">"{{ reply.reply }}"</v-card-text>

          <v-card-actions>
            <v-list-item class="grow">
              <v-list-item-avatar color="grey darken-3">
                <v-img class="elevation-6" src="http://i.pravatar.cc/64"></v-img>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{ reply.user }}</v-list-item-title>
              </v-list-item-content>

              <v-row align="center" justify="end">
                <div class="actions">
                  <like :data="reply"></like>
                  <v-btn icon v-if="own(reply.user_id)">
                    <v-icon @click="destroy(index,reply.id)">mdi-delete</v-icon>
                  </v-btn>
                </div>
              </v-row>
            </v-list-item>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import like from "./like";

export default {
  inject: ["theme"],
  props: ["replies", "questionSlug"],
  data() {
    return {
      editModeId: null
    };
  },
  created() {
    this.listen();
  },
  methods: {
    own(id) {
      return User.own(id);
    },
    listen() {
      EventBus.$on("appendNewComment", comment => {
        console.log(comment);
        this.replies.push(comment);
      });

      Echo.private("App.User." + User.id()).notification(notification => {
        this.replies.push(notification.reply);
      });
      Echo.channel("DeleteReplyChannel").listen("DeleteReplyEvent", e => {
        for (let index = 0; index < this.replies.length; index++) {
          if (this.replies[index].id == e.id) {
            this.replies.splice(index, 1);
          }
        }
      });
    },
    destroy(index, reply_id) {
      axios.delete(`/api/${this.questionSlug}/reply/${reply_id}`).then(res => {
        this.replies.splice(index, 1);
      });
    },
    edit(id) {
      this.editModeId = id;
    }
  },
  components: { like }
};
</script>
<style></style>
