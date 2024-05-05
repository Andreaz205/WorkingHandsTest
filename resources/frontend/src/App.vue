<script setup>

</script>

<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex gap-2">
                <RouterLink to="/">Главная</RouterLink>
                <RouterLink to="/create">Создать заявку</RouterLink>
            </div>
        </div>
    </div>
    <router-view></router-view>
</template>

<style scoped>

</style>
