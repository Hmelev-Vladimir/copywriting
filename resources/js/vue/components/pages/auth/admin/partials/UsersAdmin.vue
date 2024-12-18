<script setup>
import UserCard from './UserCard.vue';
import { onBeforeMount, reactive, ref } from 'vue';


const users = reactive([]);

const load = ref(true);
function getUser() {
    axios.get('/api/admin/getUser', { params: {} })
        .then((response) => {
            console.log(response);
            users.splice(0, users.length);
            users.push(...response.data.users);
        })
        .catch((error) => {
            console.log(error.response);
        })
        .finally(() => { load.value = false; });
};

onBeforeMount(() => {
    getUser();
});
</script>

<template>
    <div class="users-admin">
        <h1 class="users-admin__userName">Профили пользователей</h1>
        <div class="users-admin__adminUserContainer" v-if="!load">
            <UserCard v-for="user in users" :user="user">
            </UserCard>
        </div>
        <div class="posts__container posts__container_load" v-else>
            <Load></Load>
        </div>
    </div>

</template>

<style lang="scss">
.users-admin {
    grid-area: applications;

    &__userName {}


    &__adminUserContainer {
        padding-top: 30px;

        display: grid;
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;

    }
}
</style>
