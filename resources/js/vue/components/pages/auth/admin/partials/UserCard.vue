<script setup>

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});
</script>
<template>
    <article class="application-card">
        <div class="application-card__item">
            <img class="application-card__cover" :src="`/storage/${user.pic}`" :alt="user.name">
            <h3 class="application-card__title"> {{ user.login }} </h3>
            <p class="application-card__theme">{{ user.name }}</p>
            <p class="application-card__price">{{ user.surname }}</p>
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
        display: grid;
        grid-template-columns:
            100px minmax(40px, 1fr) minmax(40px, 1fr) minmax(40px, 1fr);
        grid-auto-flow: column;

        align-content: start;
        justify-content: center;

        box-shadow: 0px 3px 3px 0px $primary-color;
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
}
</style>
