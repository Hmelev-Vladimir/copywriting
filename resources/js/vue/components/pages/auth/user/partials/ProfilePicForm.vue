<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';
import $auth from '#/$auth';
const load = ref(false);

const picForm = ref(false);

const pic = ref(null);

const errors = reactive({
    pic: null,
});

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
            picForm.value = false;
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
    <div>
        <button @click="picForm = !picForm" class="userProfile-image__switch-form-btn">Изменить фото
            профиля</button>
        <form class="userProfile-image__form" v-show="picForm">
            <!-- Другие поля формы. -->
            <div class="userProfile-image__row">
                <input class="userProfile-image__input" :class="{ form__input_error: errors.pic !== null }" name="pic"
                    id="pic" type="file" accept="image/*" @change="uploadImg">
                <div class="userProfile-image__error" v-if="errors.pic !== null">
                    {{ errors.pic }}
                </div>
            </div>
            <div class="userProfile-image__load" v-if="load">
                <Load></Load>
            </div>
        </form>
    </div>
</template>
