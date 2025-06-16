<script setup>
import { reactive, ref } from 'vue';
import $auth from '#/$auth';

// Индикатор загрузки.
const load = ref(false);

// Индикатор, показана ли форма загрузки изображения.
const picFormShown = ref(false);

// Изображение.
const pic = ref(null);

// Ошибки.
const errors = reactive({
    pic: null,
});

/**
 * Загружает фото.
 * @param event {Event} Событие.
 */
function uploadImg(event) {
    load.value = true;

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
            picFormShown.value = false;
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
        })
        .finally(() => { load.value = false; });
}
</script>

<template>
    <div class="profile-pic-form">
        <button @click="picFormShown = !picFormShown"
            class="profile-pic-form__switch-form-btn">
            Изменить фото профиля
        </button>
        <form class="form" v-show="picFormShown">
            <div class="form__row">
                <input :class="{ form__input_error: errors.pic !== null }"
                    name="pic"
                    id="pic"
                    type="file"
                    accept="image/*"
                    @change="uploadImg">
                <div class="form__error" v-if="errors.pic !== null">
                    {{ errors.pic }}
                </div>
            </div>
            <div v-if="load">
                <Load></Load>
            </div>
        </form>
    </div>
</template>

<style lang="scss">
.profile-pic-form {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;

    &__switch-form-btn {
        @include btn;
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
        transition: all 0.2s ease-in-out;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: #f3f4f6;
    }

    input[type="file"]::file-selector-button:active {
        background-color: #e5e7eb;
    }
}
</style>