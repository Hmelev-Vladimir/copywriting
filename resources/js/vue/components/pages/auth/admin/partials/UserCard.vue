<script setup>

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});
const emit = defineEmits(['deleteUser']);
</script>
<template>
    <article class="application-card">
        <div class="application-card__item">
            <img class="application-card__cover" :src="`${appURL}/storage/${user.pic}`" :alt="user.name">
            <h3 class="application-card__title"> {{ user.login }} </h3>
            <p class="application-card__theme">{{ user.name }}</p>
            <p class="application-card__price">{{ user.surname }}</p>
        </div>
        <div class="application-card__btn-container">
            <RouterLink class="application-card__btn" :to="{ name: 'UserProfileUpdate', params: { id: user.id } }">
                Редактировать
            </RouterLink>
            <button class="application-card__btn" type="button" @click="emit('deleteUser', user)"
                v-if="user.id !== $auth.user.id">Удалить</button>
        </div>
    </article>
</template>
<style lang="scss">
.application-card {
    display: grid;
    grid-template-rows: repeat(auto-fit, minmax(50px, 1fr));
    gap: 30px;
    // .application-card__item

    &__item {
        height: 100px;
        display: grid;
        grid-template-columns:
            100px minmax(40px, 1fr) minmax(40px, 1fr) minmax(40px, 1fr);
        grid-auto-flow: column;

        align-content: start;
        justify-content: center;

        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        text-align: center;
    }

    // .application-card__cover

    &__cover {
        height: 100px;
        border-radius: 15px;
        width: 100px;
        object-fit: cover;
        object-position: center;
    }

    // .application-card__title

    &__title {
        display: grid;
        align-self: center;
    }

    // .application-card__theme

    &__theme {
        display: grid;
        align-self: center;
    }

    // .application-card__price

    &__price {
        display: grid;
        align-self: center;
    }

    &__btn {
        @include btn;
        align-content: center;
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
