<script setup>
import { onBeforeMount, reactive, ref } from 'vue';
import ApplicationCard from './partials/ApplicationCard.vue';
import axios from 'axios';

// Заявки.
const applications = reactive([]);

// Фильтры.
const filters = reactive({
    status: '',
    user: 'all',
    search: '',
});

// Индикатор загрузки.
const load = ref(true);

/**
 * Получает список заявок.
 */
function getList() {
    axios.get('/api/applications/getList', { params: { ...filters } })
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
                alert('Ошибка! Заявки с подобным id не существует.');
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

        <div class="applications__filters filters">
            <h2>Фильтры</h2>
            <form class="form" @submit.prevent="getList">
                <div class="form__row">
                    <label class="form__label">Статус</label>
                    <select id="status" name="status" v-model="filters.status" class="form__input">
                        <option value="">Все</option>
                        <option>Новая</option>
                        <option>Опубликовано</option>
                        <option>На модерации</option>
                        <option>В архиве</option>
                        <option>Откликнулись</option>
                        <option>Куплено</option>
                    </select>
                </div>
                <div class="form__row">
                    <label class="form__label">Тип</label>
                    <select id="type" name="type" class="form__input" v-model="filters.type" >
                        <option value="all">Все заявки</option>
                        <option value="all-mine">Мои все заявки</option>
                        <option value="customer">Мои заявки как заказчик</option>
                        <option value="executor">Мои заявки как исполнителя</option>
                    </select>
                </div>
                <div class="form__row">
                    <label class="form__label">Поиск по тексту</label>
                    <input id="search" name="search" class="form__input" type="text" placeholder="Поиск" v-model="filters.search" >
                 </div>
                 <button class="form__btn" type="submit">Применить фильтры</button>
            </form>
        </div>

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
    grid-template-columns: 1fr 2fr 2fr;
    grid-template-rows: repeat(2, max-content);
    grid-template-areas:
        'filters title btn'
        'filters container container';
    ;
    align-items: center;
    row-gap: 1rem;
    column-gap: 2.5rem;
    // .applications__title

    &__filters {
        grid-area: filters;
        align-self: start;
    }

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

.filters {
    @include card;
    padding: 0.5rem;
    display: grid;
    top: 0;
    position: sticky;
}
</style>
