<template>
  <div class="content" style="flex: 1; display:flex; align-items: center; justify-content: center; background-color: #00aeb5">
    <v-img      
      v-bind:src="require('../assets/+a-01.png')"
      contain
      :height="200"
    ></v-img>
  </div>
</template>

<script>
export default {
  name: "Home",
};
</script>

<style scoped>
.content {
  display: flex;
  justify-content: center;
}
</style>