<script setup>
import { ref } from 'vue';

// Входные данные компонента.
const props = defineProps({
    application: {
        type: Object,
        required: true
    }
});

// Излучатель.
const emit = defineEmits(['deleteApplication']);

// Сообщение.
const message = ref(null);

/**
 * Отклик на заявку.
 */
function respond() {
    const formData = new FormData();
    formData.append('id', props.application.id);

    axios.post('api/user/applications/respond', formData)
        .then((response) => {
            console.log(response);
            message.value = response.data.message;
        })
        .catch((error) => {
            console.log(error.response);
        });
};
</script>

<template>
    <Alert v-if="message !== null">{{ message }}</Alert>

    <article class="application-card">
        <div class="application-card__item">
            <img class="application-card__cover" :src="`${appURL}/storage/${application.cover}`" :alt="application.title">
            <h3 class="application-card__title"> {{ application.title }} </h3>
            <p class="application-card__theme">{{ application.theme }}</p>
            <p class="application-card__price">{{ application.price }} РУБ</p>
            <p class="application-card__price"><b>Заказчик: </b>{{ application.user.full_name }}</p>
            <p class="application-card__status"> {{ application.status }} </p>
            <p class="application-card__publicationDate">
                {{ new Date(application.publicationDate).toLocaleString() }}
            </p>
            <div class="application-card__btn-container">
                <RouterLink class="application-card__btn"
                    :to="{ name: 'ApplicationShow', params: { id: application.id } }">
                    Посмотреть
                </RouterLink>
                <RouterLink class="application-card__btn"
                    v-if="$auth.user.role === 'admin' || application.user_id === $auth.user.id"
                    :to="{ name: 'ApplicationUpdate', params: { id: application.id } }">
                    Редактировать
                </RouterLink>
                <button v-if="$auth.user.role === 'admin' || application.user_id === $auth.user.id"
                    class="application-card__btn" type="button"
                    @click="emit('deleteApplication', application)">
                    Удалить
                </button>
                <button v-if="(application.executor_id === null && application.user_id !== $auth.user.id)"
                    class="application-card__btn" type="button"
                    @click="respond">
                    Откликнуться
                </button>
            </div>
        </div>
    </article>
</template>

<style lang="scss">
.application-card {
    @include card;
    padding: 0.5rem;

    display: grid;
    grid-auto-rows: max-content;
    grid-auto-flow: row;
    gap: 1rem;

    &__item {
        display: grid;
        grid-template-rows:
            auto minmax(40px, 1fr) minmax(40px, 1fr) minmax(40px, 1fr);
        grid-template-columns: 1fr;
        grid-auto-rows: auto;

        align-content: start;
        justify-content: center;

        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
    }

    &__cover {
        height: 200px;
        width: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 15px;
    }

    // .application-card__title

    &__title {
        display: grid;
        padding-top: 20px;
        justify-self: center;
    }

    // .application-card__theme

    &__theme {
        justify-self: center;
    }

    // .application-card__price

    &__price {
        justify-self: center;
    }

    // .application-card__description

    &__description {
        justify-self: center;
        text-align: center;
    }

    &__status {
        justify-self: center;
        align-self: end;
        padding: 10px;
        background-color: #f2f2f2;
        border-radius: 5px;
    }

    &__publicationDate {
        justify-self: center;
        align-self: end;
        padding: 5px;
        color: grey;
    }

    &__btn {
        @include btn;
    }

    &__btn-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 10px;
    }
}
</style>
