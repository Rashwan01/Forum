<template>
  <v-btn icon @click="likeIt">
    <v-icon class="mx-2" :color="color">mdi-cards-heart</v-icon>
    {{ count }}
  </v-btn>
</template>
<script>
export default {
  props: ["data"],
  data() {
    return {
      liked: this.data.liked,
      count: this.data.likeCount
    };
  },
  created(){

Echo.channel('likeChannel')
    .listen('LikeEvent', (e) => {

       if(this.data.id == e.id)
       {
           e.type == 1 ? this.count++:this.count--;
           console.log(e.id)
       }
    });
  },
  computed: {
    color() {
      return this.liked ? "red" : "red lighten-4";
    }
  },
  methods: {
    likeIt() {
      if (User.isLogin()) {
        this.liked ? this.decr() : this.incr();
        this.liked = !this.liked;
      }
    },
    incr() {
      axios.post(`/api/like/${this.data.id}`).then(res => {
        this.count++;
      });
    },
    decr() {
      axios.delete(`/api/like/${this.data.id}`).then(res => {
        this.count--;
      });
    }
  }
};
</script>
<style>
</style>
