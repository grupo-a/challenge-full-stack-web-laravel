<template>
  <div id="app">
    <v-app>
      <Header />
      <router-view></router-view>
    </v-app>
  </div>
</template>

<script>
import Header from "@/components/Header";

export default {
  name: "App",
  components: {
    Header,
  },
};
</script>