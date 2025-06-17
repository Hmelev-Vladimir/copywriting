<script setup>
import { reactive, computed, onBeforeMount } from 'vue';
import { useRouter } from 'vue-router';

// Входные данные компонента.
const props = defineProps({
    id: {
        type: [String, Number],
        default: 0
    }
});

// Роутер.
const router = useRouter();

// Заявка.
const application = reactive({
    id: -1,
    cover: '',
    title: '',
    theme: '',
    price: '',
    status: '',
    reason: '',
    description: '',
    publicationDate: '',
    created_at: '',
    updated_at: '',
    user: { surname: '' },
});

/**
 * Получает заявку.
 */
function getApplication() {
    axios.get('/api/applications/getApplication', { params: { id: props.id } })
        .then((response) => {
            console.log(response);
            for (const key in response.data.application) {
                application[key] = response.data.application[key];
            }
        })
        .catch((error) => {
            console.log(error.response);
            alert(`Ошибка ${error.response.status}`);
            router.push({ name: 'Applications' });
        });
}

onBeforeMount(() => {
    getApplication();
});
</script>

<template>
    <div class="breadcrumbs">
        <RouterLink
            :to="{ name: 'Applications'}">
            Заявки
        </RouterLink>
        <span>➤</span>
        <span>{{ application.title }}</span>
    </div>

    <div class="applicationShow">
        <img class="applicationShow__cover" :src="`${appURL}/storage/${application.cover}`" :alt="application.title">
        <div class="applicationShow__item">
            <h1 class="applicationShow__title"> {{ application.title }} </h1>
            <p class="applicationShow__theme"><b>Тема:</b> {{ application.theme }}</p>
            <p class="applicationShow__price">{{ application.price }} РУБ</p>
            <p class="applicationShow__price"><b>Автор:</b> {{ application.user.surname }}</p>
            <p class="applicationShow__description"><b>Описание:</b> {{ application.description }}</p>
            <p class="applicationShow__status"><b>Статус:</b> {{ application.status }} </p>
            <div class="applicationShow__dateCont">
                <div class="applicationShow__date">
                    <span>Опубликовано</span>
                    <span>
                        {{ new Date(application.publicationDate).toLocaleString() }}
                    </span>
                </div>
                <div class="applicationShow__date">
                    <span>Создано</span>
                    <span>
                        {{ new Date(application.created_at).toLocaleString() }}
                    </span>
                </div>
                <div class="applicationShow__date">
                    <span>Изменено</span>
                    <span>
                        {{ new Date(application.updated_at).toLocaleString() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.applicationShow {
    @include outerContainer;
    @include card;

    display: grid;
    grid-template-columns: auto 1fr;
    grid-template-areas: 'cover content';
    margin-top: 1rem;
    margin-bottom: 1rem;
    gap: 0.6rem;
    @include mobile {
        grid-template-areas:
            'cover'
            'content';
        grid-template-columns: 1fr;
        grid-template-rows: repeat(2,max-content);
    }

    // .applicationShow__cover

    &__cover {
        height: 500px;
        width: 100%;
        object-fit: cover;
        grid-area: cover;
    }

    // .applicationShow__item

    &__item {
        grid-area: content;
        display: grid;
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;
        gap: 1rem;
        margin-left: 0.5rem;
        justify-items: start;
    }

    // .applicationShow__title
    &__description {
        font-size: 1.5rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;

    }

    &__title {
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        font-size: 26pt;
    }

    // .applicationShow__theme

    &__theme {
        display: grid;
        grid-template-columns: auto;
        grid-auto-flow: column;
        gap: 2rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        font-size: 15pt;
        border: 1px solid black;
        padding: 10px;
    }

    // .applicationShow__price

    &__price {
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        font-size: 1.5rem;
        font-weight: bold;

    }

    // .applicationShow__status

    &__status {
        padding-top: 50px;
        font-size: 1.5rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
    }

    // .applicationShow__publicationDate

    // .applicationShow__dateCont

    &__dateCont {
        display: grid;
        grid-template-columns: auto;
        grid-auto-flow: column;
        gap: 2rem;

        @include mobile {
            grid-template-columns: 1fr;
            grid-auto-flow: row;
            gap: 0.5rem;
        }
    }

    // .applicationShow__created-at
    &__date {
        padding: 1rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        display: grid;
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;
        justify-items: center;
        border: 1px solid $secondary;

        span:first-child{
            font-weight: bold;
        }
    }
}
</style>
