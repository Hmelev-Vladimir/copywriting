<script setup>
import { reactive, ref } from 'vue';
import $auth from '#/$auth';
import axios from 'axios';
const emit = defineEmits(['send-form']);

const picForm = ref(false);

const pic = ref(null);

const errors = reactive({
    pic: null,
});

function uploadImg(event) {

    if (event.target.files[0] instanceof File) {
        pic.value = event.target.files[0];
    } else {
        pic.value = null;
    }

    const formData = new FormData();
    formData.append('pic', pic.value);


    axios.post('api/user/updatePic', formData)
        // Удачный отклик.
        .then((response) => {
            console.log(response);
            $auth.user.pic = response.data.pic;
        })
        // Неудачный отклик.
        .catch((error) => {
            console.log(error.response);
            // Обработка ошибок.

            // Обнуление старых ошибок.
            for (const key in errors) {
                errors[key] = null;
            }

            // Получение новых ошибок с сервера.
            if (error.response.status === 422) {
                for (const key in error.response.data.errors) {
                    if (errors.hasOwnProperty(key)) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                }
            }
        });
}


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
        <div class="userProfile-image">
            <img class="userProfile-image__cover" :src="`/storage/${$auth.user.pic}`" :alt="$auth.user.name">
            <button @click="picForm = !picForm" class="userProfile-image__btn">Изменить фото профиля</button>
            <form class="userProfile-image__form" @submit.prevent="emit('send-form')" v-show="picForm">
                <!-- Другие поля формы. -->
                <div class="userProfile-image__row">
                    <label class="userProfile-image__label" :class="{ form__label_error: errors.pic !== null }"
                        for="pic">
                        Изображение профиля
                    </label>
                    <input class="userProfile-image__input" :class="{ form__input_error: errors.pic !== null }"
                        name="pic" id="pic" type="file" accept="image/*" @change="uploadImg">
                    <div class="userProfile-image__error" v-if="errors.pic !== null">
                        {{ errors.pic }}
                    </div>

                </div>
                <!-- Другие поля формы. -->
                <button class="userProfile-image__btn2" type="submit">
                    Изменить изображение профиля
                </button>
            </form>
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
    grid-template-rows: repeat(2, max-content);
    grid-template-areas: 'cover' 'form';
    grid-area: pic;
    width: 500px;
    // .userProfile-image__cover

    &__cover {
        grid-area: cover;
    }

    &__btn2 {
        grid-area: 'btn2';
        @include btn;
    }

    // .userProfile-image__form

    &__form {
        display: grid;
        grid-template-columns: repeat(2, max-content);
        grid-template-areas: 'row btn2';
        grid-area: form;
    }

    // .userProfile-image__row

    &__row {
        grid-area: row;
        display: grid;
        grid-area: row;
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

// input[type="file"]::file-selector-button {
//     border-radius: 4px;
//     padding: 0 16px;
//     height: 40px;
//     cursor: pointer;
//     background-color: white;
//     border: 1px solid rgba(0, 0, 0, 0.16);
//     box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
//     margin-right: 16px;
//     transition: background-color 200ms;
// }

// /* file upload button hover state */
// input[type="file"]::file-selector-button:hover {
//     background-color: #f3f4f6;
// }

// /* file upload button active state */
// input[type="file"]::file-selector-button:active {
//     background-color: #e5e7eb;
// }</style>
