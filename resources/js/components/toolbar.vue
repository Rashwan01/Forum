<template>
  <div>
    <v-toolbar dense>
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>lol</v-toolbar-title>
<notification></notification>
      <v-spacer></v-spacer>
      <div
        class="mx-2"
        v-for="(navbarItem,index) in navbarItems"
        :key="index"
        v-if="navbarItem.show"
      >
        <v-btn rounded text color="white" :to="navbarItem.to" elevation="25">{{navbarItem.title}}</v-btn>
      </div>
    </v-toolbar>

    <router-view></router-view>
  </div>
</template>

<script>
import notification from "./notifications";
export default {
  data() {
    return {
      navbarItems: [
        { title: "Forum", to: "/forum", show: "true" },
        { title: "ask Question", to: "/askquestion", show: User.isLogin() },
        { title: "category", to: "/category/create", show: User.isAdmin() },
        { title: "login", to: "/login", show: !User.isLogin() },
        { title: "logout", to: "/logout", show: User.isLogin() }
      ]
    };
  },
  created() {
    EventBus.$on("logout", () => {
      User.logout();
      this.$router.push({ name: "/forum" });
    });
  },
  components: {
    notification
  }
};
</script>

<style>
</style>
