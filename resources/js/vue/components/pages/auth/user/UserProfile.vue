<script setup>
import $auth from '#/$auth';
import ProfilePicForm from './partials/ProfilePicForm.vue';
const emit = defineEmits(['send-form']);
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
            <div class="userProfile-info__btn-container">
                <RouterLink class="userProfile-info__btn"
                    :to="{ name: 'UserProfileUpdate', params: { id: $auth.user.id } }">
                    Редактировать
                </RouterLink>
            </div>
        </div>
        <div class="userProfile-image" v-if="!load">
            <img class="userProfile-image__cover" :src="`/storage/${$auth.user.pic}`" :alt="$auth.user.name">

            <ProfilePicForm class="post-create__form">
            </ProfilePicForm>
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

    &__btn-container {
        margin-top: 20px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 10px;
        box-shadow: 0px 0px 3px 0px $primary-color;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    &__btn {
        display: grid;
        align-self: center;
        @include btn;
    }

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
    padding-right: 10px;
    display: grid;
    grid-template-rows: repeat(3, max-content);
    grid-template-areas: 'cover' 'switch-form-btn' 'form';
    grid-area: pic;
    width: 500px;
    gap: 20px;
    // .userProfile-image__cover

    &__cover {
        grid-area: cover;
    }

    &__btnSubmit {
        grid-area: submit;
        @include btn;
    }


    &__switch-form-btn {
        grid-area: switch-form-btn;
        display: grid;
        align-self: center;
        @include btn;
    }

    // .userProfile-image__form

    &__form {
        display: grid;
        grid-area: form;
        grid-template-rows: repeat(2, max-content);
        grid-template-areas: 'input' 'submit';
    }

    // .userProfile-image__row

    &__row {
        grid-area: input;
        display: grid;
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 0.5rem;
    }

    // .userProfile-image__label

    &__label {
        font-size: 1.2rem;
        text-align: center;
    }

    // .userProfile-image__input

    &__input {}

    // .userProfile-image__error

    &__error {
        color: $error-color;
    }

    // .userProfile-image__btn

    &__btn {
        grid-area: submit;
        display: grid;
        justify-self: center;
        margin-top: 20px;
        @include btn;
    }

    // .userProfile-image__cover

    &__cover {
        justify-self: center;
        width: 200px;
        border-radius: 15px;
    }
}

input[type="file"]::file-selector-button {
    border-radius: 4px;
    padding: 0 16px;
    height: 40px;
    cursor: pointer;
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.16);
    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
    margin-right: 16px;
    transition: background-color 200ms;
}

// /* file upload button hover state */
input[type="file"]::file-selector-button:hover {
    background-color: #f3f4f6;
}

// /* file upload button active state */
input[type="file"]::file-selector-button:active {
    background-color: #e5e7eb;
}
</style>
