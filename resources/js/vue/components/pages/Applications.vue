<script setup>
import { onBeforeMount, reactive, ref } from 'vue';
import ApplicationCard from './partials/ApplicationCard.vue';
import axios from 'axios';

// Заявки.
const applications = reactive([]);

// Индикатор загрузки.
const load = ref(true);

/**
 * Получает список заявок.
 */
function getList() {
    axios.get('/api/applications/getList', { params: {} })
        .then((response) => {
            console.log(response);
            applications.splice(0, applications.length);
            applications.push(...response.data.applications);
        })
        .catch((error) => {
            console.log(error.response);
        })
        .finally(() => { load.value = false; });
};

/**
 * Удаляет заявку.
 */
function deleteApplication(application) {
    if (confirm('Хотите удалить данную заявку?')) {
        axios.delete('/api/applications/delete', { params: { id: application.id } })
            .then((response) => {
                console.log(response);
                const index = applications.indexOf(application);
                applications.splice(index, 1);
            }).catch((error) => {
                console.log(error.response);
                alert('Ошибка! Объявления с подобным id нет');
            });

    }
}

onBeforeMount(() => {
    getList();
});
</script>

<template>
    <section class="applications">
        <h1 class="applications__title">Заявки</h1>
        <RouterLink class="applications__btn"
            :to="{ name: 'ApplicationCreate' }">
            Создать заявку
        </RouterLink>
        <div class="applications__container" v-if="!load">
            <ApplicationCard v-for="application in applications" :application="application"
                @deleteApplication="deleteApplication">
            </ApplicationCard>
        </div>
        <div class="applications__container applications__container_load" v-else>
            <Load></Load>
        </div>
    </section>
</template>

<style lang="scss">
.applications {
    @include outerContainer;

    margin-top: 1rem;
    margin-bottom: 1rem;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, max-content);
    grid-template-areas:
        'title btn'
        'container container';
    ;
    align-items: center;
    gap: 1rem;
    // .applications__title

    &__title {
        @include title;
        grid-area: title;
        justify-self: start;
    }

    // .applications__container
    &__btn {
        @include btn;
        grid-area: btn;
        justify-self: end;
    }

    &__container {
        grid-area: container;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;

        &_load {
            grid-template-columns: 1fr;
            justify-items: center;
        }
    }


}
</style>
