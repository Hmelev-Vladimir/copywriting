<script setup>
import $auth from '../../../../global/$auth';
</script>
<template>
    <section class="userProfile">
        <div class="userProfile-info">
            <h2 class="userProfile-info__h2">Профиль: {{ $auth.user.login }}</h2>
            <ul class="userProfile-info__list">
                <li class="userProfile-info__listItem">Имя: {{ $auth.user.name }}</li>
                <li class="userProfile-info__listItem">Фамилия: {{ $auth.user.surname }}</li>
                <li class="userProfile-info__listItem">Телефон: {{ $auth.user.phone }}</li>
                <li class="userProfile-info__listItem">Email: {{ $auth.user.email }}</li>
            </ul>
            <div class="application-card__btn-container">
                <RouterLink class="application-card__btn"
                    :to="{ name: 'UserProfileUpdate', params: { id: $auth.user.id } }">
                    Редактировать
                </RouterLink>
            </div>
        </div>
        <div class="userProfile-image">
            <img class="userProfile-image__cover" :src="`/storage/${$auth.user.pic}`" :alt="$auth.user.name">
        </div>
    </section>
</template>
<style lang="scss">
.userProfile {
    padding-top: 20px;
    display: grid;
    justify-self: center;
    // grid-template-columns: repeat(2, max-content);
    // grid-template-areas: 'profile-image' 'profile-info';
    grid-template-columns: repeat(2, max-content);
    grid-template-areas:
        'pic info';
}

.userProfile-info {
    grid-area: info;

    &__h2 {
        font-size: 20pt;
        text-align: center;
        color: $secondary-color;
        padding: 5px;
        box-shadow: 0px 0px 3px 0px $primary-color;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;

    }

    &__list {
        margin-top: 10px;
        padding: 10px;
        display: grid;
        list-style: none;
        gap: 10px;
        font-size: 15pt;
        box-shadow: 0px 3px 3px 0px $primary-color;
        border-radius: 15px;
    }

    &__listItem {
        color: $secondary-color;
        font-weight: bold;
        padding: 5px;
        box-shadow: 0px 0px 3px 0px $primary-color;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
}

.userProfile-image {
    display: grid;
    grid-area: pic;
    width: 500px;

    // .userProfile-image__cover

    &__cover {
        justify-self: center;
        width: 200px;
        border-radius: 15px;
    }
}
</style>
