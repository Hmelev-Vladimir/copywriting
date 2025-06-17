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
function deleteUser(user) {
    if (confirm('Хотите удалить данного пользователя?')) {
        axios.delete('/api/users/delete', { params: { id: user.id } })
            .then((response) => {
                console.log(response);
                const index = users.indexOf(user);
                users.splice(index, 1);
            }).catch((error) => {
                console.log(error.response);
                alert('Ошибка! Пользователя с подобным id нет');
            });

    }
}
</script>

<template>
    <div class="users-admin">
        <h2 class="users-admin__userName">Пользователи</h2>
        <div class="users-admin__adminUserContainer" v-if="!load">
            <UserCard v-for="user in users" :user="user" @deleteUser="deleteUser">
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

    &__userName {
        @include title;
        justify-self: start;
    }


    &__adminUserContainer {
        padding-top: 30px;

        display: grid;
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;

    }
}
</style>
