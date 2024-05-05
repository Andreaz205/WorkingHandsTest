import {createApp} from 'vue'
import {createRouter, createWebHistory} from "vue-router";
import CreateApplication from "@/pages/application/CreateApplication.vue";
import ShowApplication from "@/pages/application/ShowApplication.vue";
import ListApplications from "@/pages/application/ListApplications.vue";
import App from "@/App.vue";

const routerHistory = createWebHistory()

const router = new createRouter({
    history: routerHistory,
    routes: [
        { path: '/', component: ListApplications, name: 'ListApplications' },
        { path: '/create', component: CreateApplication, name: 'CreateApplication' },
        { path: '/:id', component: ShowApplication, name: 'ShowApplication' },
    ]
});

const app  = createApp(App)

app.use(router).mount('#app')
