<template>
  <v-btn
    elevation="1"    
    :to=this.route
    append
  >
    {{ this.caption }}
  </v-btn>
</template>

<script>
export default {
  props: ["route", "caption"],    
};
</script>