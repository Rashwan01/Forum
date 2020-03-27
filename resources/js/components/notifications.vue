<template>
  <div class="text-center">
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on" icon>
          <v-icon>mdi-bell</v-icon>
          {{ unreadCount }}
        </v-btn>
      </template>

      <v-list>
        <v-list-item v-for="(item,index) in unread" :key="index">
          <router-link :to="item.path">
            <v-list-item-title @click="readIt(item)">
              <b>{{item.replyBy }}</b>
              reply on {{item.question}}

            </v-list-item-title>
          </router-link>

          <v-divider></v-divider>
        </v-list-item>

        <v-list-item v-for="(item,index) in read" :key="index+item">
          <v-list-item-title>
            <b>{{item.replyBy }}</b>
            reply on {{ item.question}}
          </v-list-item-title>

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
      unreadCount: 0,
      sound: "http://soundbible.com/mp3/Air%20Plane%20Ding-SoundBible.com-496729130.mp3"
    };
  },
  created() {
    if (User.isLogin()) {
      this.getNotificaions();
    }

    Echo.private("App.User." + User.id()).notification(notification => {
      this.unread.unshift(notification);
      this.unreadCount++;
      this.playSound();
    });
  },
  methods: {
    playSound() {
      let alert = new Audio(this.sound);
      alert.play();
    },
    getNotificaions() {
      axios
        .post("/api/notifications")
        .then(res => {
          this.read = res.data.read;
          this.unread = res.data.unread;
          this.unreadCount = res.data.unread.length;
        })
        .catch(error => Exception.handle(error));
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
