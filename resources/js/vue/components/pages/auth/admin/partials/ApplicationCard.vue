<script setup>
const props = defineProps({
    application: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['deleteApplication']);
</script>

<template>
    <article class="adminApplication-card">
        <div class="adminApplication-card__item">
            <img class="adminApplication-card__cover" :src="`${appURL}/storage/${application.cover}`" :alt="application.title">
            <h3 class="adminApplication-card__title"> {{ application.title }} </h3>
            <p class="adminApplication-card__theme">Тема: {{ application.theme }}</p>
            <p class="adminApplication-card__price">{{ application.price }} РУБ</p>
            <p class="adminApplication-card__status"> {{ application.status }} </p>
            <p class="adminApplication-card__publicationDate">
                {{ new Date(application.publicationDate).toLocaleString() }}
            </p>
            <p class="adminApplication-card__author">
                Автор: {{ application.user.surname }}
            </p>
            <div class="adminApplication-card__btn-container">
                <RouterLink class="adminApplication-card__btn"
                    :to="{ name: 'ApplicationShow', params: { id: application.id } }">
                    Посмотреть
                </RouterLink>
                <RouterLink class="adminApplication-card__btn"
                    :to="{ name: 'ApplicationUpdate', params: { id: application.id } }">
                    Редактировать
                </RouterLink>
                <button class="adminApplication-card__btn" type="button"
                    @click="emit('deleteApplication', application)">Удалить</button>
            </div>
        </div>
    </article>
</template>
<style lang="scss">
.adminApplication-card {
    @include card;
    padding: 0.5rem;

    display: grid;
    grid-auto-rows: max-content;
    grid-auto-flow: row;
    gap: 1rem;

    &__item {
        display: grid;
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        grid-template-columns: 1fr;
        gap: 0.5rem;

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
        justify-self: center;
        padding-top: 20px;
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


    &__author {
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
