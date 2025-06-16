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
    <article class="application-card">
        <div class="application-card__item">
            <img class="application-card__cover" :src="`/storage/${application.cover}`" :alt="application.title">
            <h3 class="application-card__title"> {{ application.title }} </h3>
            <p class="application-card__theme">{{ application.theme }}</p>
            <p class="application-card__price">{{ application.price }} РУБ</p>
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
                    :to="{ name: 'ApplicationUpdate', params: { id: application.id } }">
                    Редактировать
                </RouterLink>
                <button v-if="$auth.user.role === 'admin'" class="application-card__btn" type="button"
                    @click="emit('deleteApplication', application)">Удалить</button>
            </div>
        </div>
    </article>
</template>
<style lang="scss">
.application-card {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;

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
        height: 300px;
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
