<script setup>
import {onBeforeMount, ref, watch} from "vue";
    import axios from "axios";
import {useRouter} from "vue-router";

    const applicationsPagination = ref()

    const router = useRouter()
    const listUrl = "http://localhost:8000/api/applications"

    const route = router.currentRoute

    watch(route, async (newRoute) => {
        try {
            const {data} = await axios.get(listUrl, {
                params: {
                    page: newRoute.query.page,
                    sort_by_date: newRoute.query.sort_by_date,
                    sort_by_price: newRoute.query.sort_by_price,
                }
            })

            applicationsPagination.value = data
        } catch (e) {
            alert(e.message)
        }
    })

    onBeforeMount(async () => {
        try {
            const {data} = await axios.get(listUrl, {
                params: {
                    page: route.value.query.page
                }
            })

            applicationsPagination.value = data
        } catch (e) {
            alert(e.message)
        }
    })
</script>

<template>
    <div class="card">
        <div class="card-header">
            Список заявок
        </div>

        <div class="card-body">
            <template v-if="applicationsPagination">
                <ul class="list-group mt-2" v-for="application in applicationsPagination.data" :key="application.id">
                    <li class="list-group-item">ID: {{application.id}}</li>
                    <li class="list-group-item">Название: {{application.name}}</li>
                    <li class="list-group-item">Цена: {{application.price}}</li>
                    <li v-if="application.description" class="list-group-item">Описание: {{application.description}}</li>
                    <li class="list-group-item">Ссылка: {{application.link}}</li>
                    <li class="list-group-item"><RouterLink :to="`/${application.id}`">Подробнее</RouterLink></li>
                </ul>
            </template>

        </div>

        <div class="card-footer">
            <ul class="pagination" v-if="applicationsPagination?.meta?.last_page > 1">

                <li :class="['page-item', {'disabled': applicationsPagination.meta.current_page === 1}]">
                    <RouterLink class="page-link"
                        to="?page=1"
                    >
                        Первая
                    </RouterLink>
                </li>

                <li v-for="link in applicationsPagination.meta.links.slice(1, -1)" :key="link.label" :class="['page-item', {'active': link.active}]">
                    <RouterLink
                        class="page-link"
                        :to="`?page=${+link.label}`"
                    >
                        {{link.label}}
                    </RouterLink>
                </li>


                <li :class="['page-item', {'disabled': applicationsPagination.meta.last_page === applicationsPagination.meta.current_page}]">
                    <RouterLink class="page-link"
                       :to="`?page=${applicationsPagination.meta.last_page}`">
                        Последняя
                    </RouterLink>
                </li>
            </ul>
        </div>
        <RouterLink to="?sort_by_date=desc">
            <button class="btn btn-primary">
                Сортировать по дате создания с убыванием
            </button>
        </RouterLink>
        <RouterLink to="?sort_by_date=asc">
            <button class="btn btn-primary mt-2">
                Сортировать по дате создания с возрастанием
            </button>
        </RouterLink>
        <RouterLink to="?sort_by_price=desc">
            <button class="btn btn-primary mt-2">
                Сортировать по цене с убыванием
            </button>
        </RouterLink>
        <RouterLink to="?sort_by_price=asc">
            <button class="btn btn-primary mt-2">
                Сортировать по цене с возрастанием
            </button>
        </RouterLink>
    </div>
</template>

<style scoped>

</style>
