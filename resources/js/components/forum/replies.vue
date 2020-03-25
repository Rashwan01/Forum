<template>
  <div>
    <h1 class="mt-10 mb-10 text-center">Replies</h1>
    <v-timeline>
      <v-timeline-item v-for="(reply, index) in replies" :key="index" large>
        <template v-slot:icon>
          <v-avatar>
            <img src="http://i.pravatar.cc/64" />
          </v-avatar>
        </template>
        <template v-slot:opposite>
          <p>
            {{ reply.user }}
            <br />
            <span class="grey--text">
              {{
              reply.create_at
              }}
            </span>
          </p>
        </template>
        <v-card class="elevation-2">
          <v-card-text>
            {{ reply.reply }}
            <div class="actions" >

           <like :data="reply"></like>
              <v-spacer></v-spacer>
              <v-btn icon v-if="own(reply.user_id)">
                <v-icon @click="destroy(index,reply.id)">mdi-delete</v-icon>
              </v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-timeline-item>
    </v-timeline>
  </div>
</template>
<script>
import like from "./like"

export default {

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
          console.log(comment)
        this.replies.unshift(comment);
        window.scrollTo(0, 0);
      });

      Echo.private('App.User.' + User.id())
    .notification((notification) => {
        this.replies.unshift(notification.reply)
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
  components:{like}

};
</script>
<style></style>
