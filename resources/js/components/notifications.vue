<template>
  <div class="text-center">
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on" icon>
          <v-icon>mdi-bell</v-icon>{{ unreadCount }}
        </v-btn>
      </template>
      <v-list>
        <v-list-item v-for="(item,index) in unread" :key="index">
          <router-link :to="item.path">
            <v-list-item-title @click="readIt(item)"><b>{{item.replyBy }}</b> reply on {{item.question}}</v-list-item-title>
          </router-link>

          <v-divider></v-divider>
        </v-list-item>

          <v-list-item v-for="(item,index) in read" :key="index+item">

            <v-list-item-title><b>{{item.replyBy }}</b> reply on {{ item.question}}</v-list-item-title>

          <v-divider></v-divider>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>
<script>
export default {
  data() {
    return {
      read: {},
      unread: {},
      unreadCount:0
    };
  },
  created() {
    if (User.isLogin()) {
      this.getNotificaions();
    }
    console.log(this.read)
  },
  methods: {
    getNotificaions() {
      axios
        .post("/api/notifications")
        .then(res => {
          this.read = res.data.read;
          this.unread = res.data.unread;
          this.unreadCount= res.data.unread.length;

        })
        .catch(error => console.log(error));
    },
    readIt(Notification) {
      axios
        .post("/api/markAsRead", { id: Notification.id })
        .then(res => {

          this.unread.splice(Notification, 1);
          this.unreadCount -= 1;
        })
        .catch(error => console.log(error));
    }
  }
};
</script>
<style>
</style>
