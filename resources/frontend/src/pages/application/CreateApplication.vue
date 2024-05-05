<script setup>
    import {ref, } from "vue";
    import axios from "axios";
    import {useRouter} from "vue-router";

    const links = ref([{
        value: ""
    }])

    const name = ref("")
    const description = ref("")
    const price = ref(0)


    const router = useRouter()

    function addLink() {
       if (links.value.length < 3) {
           links.value.push({
               value: ""
           })
       }
    }

    function removeLink(link) {
        if (links.value.length !== 1) {
            const idx = links.value.indexOf(link)
            links.value.splice(idx, 1)
        }
    }

    async function onSubmit() {
        try {
            await axios.post("http://localhost:8000/api/applications", {
                name: name.value,
                description: description.value,
                price: price.value,
                links: links.value.map(link => link.value)
            })
            await router.push("/")
        } catch (e) {
            alert(e.message)
        }
    }
</script>

<template>
    <div class="card">
        <div class="card-header">
            Создать заявку
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="applicationName">Название</label>
                <input v-model="name" type="text" class="form-control" id="applicationName" aria-describedby="nameHelp" placeholder="Введите название">
            </div>
            <div class="form-group">
                <label for="applicationDescription">Описание</label>
                <textarea v-model="description" class="form-control" id="applicationDescription" aria-describedby="descriptionHelp" placeholder="Введите описание" />
            </div>

            <div class="form-group">
                <label for="applicationPrice">Цена</label>
                <input v-model="price" class="form-control" id="applicationPrice" aria-describedby="priceHelp" placeholder="Введите цену" />
            </div>

            <button class="btn btn-primary" @click="addLink">Добавить ссылку</button>

            <div class="form-group" v-for="(link, index) in links" :key="index">
                <label :for="`applicationLink${index + 1}`">Ссылка {{index + 1}}</label> <button class="btn btn-danger" @click="removeLink(link)">Удалить</button>
                <input type="text" class="form-control" :id="`applicationLink${index + 1}`" placeholder="Введите ссылку" v-model="links[index].value">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" @click="onSubmit">Создать</button>
        </div>
    </div>
</template>

<style scoped>

</style>
