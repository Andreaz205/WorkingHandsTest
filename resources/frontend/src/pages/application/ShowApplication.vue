<script setup>
import {onBeforeMount, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";

const application = ref()
const router = useRouter()

onBeforeMount(async () => {
    try {
        const {data} = await axios.get(`http://localhost:8000/api/applications/${router.currentRoute.value.params.id}`)

        application.value = data.data
    } catch (e) {
        alert(e.message)
    }
})
</script>

<template>
    <div class="card" v-if="application">
        <div class="card-header">
            {{ application.name }}
        </div>

        <div class="card-body">
            <ul class="list-group mt-2">
                <li class="list-group-item">ID: {{application.id}}</li>
                <li class="list-group-item">Цена: {{application.price}}</li>
                <li v-if="application.description" class="list-group-item">Описание: {{application.description}}</li>
                <template v-if="application.links">
                    <li class="list-group-item">Ссылки:</li>
                    <li class="list-group-item" v-for="link in application.links" :key="link.id">
                        {{link.link}}
                    </li>

                </template>
            </ul>
        </div>
    </div>
</template>

<style scoped>

</style>
