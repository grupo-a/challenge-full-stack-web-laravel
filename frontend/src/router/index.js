import Vue from 'vue';
import VueRouter from "vue-router";
import Student from "../views/student/Index.vue";
import Home from "../views/Home.vue";
import CreateStudent from "../views/student/Create.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: Home
  },
  {
    path: "/student",
    component: Student,   
  },
  {
    path: "/student/create",
    component: CreateStudent,
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
