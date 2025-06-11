<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import $auth from '../../../global/$auth.js';

/**
 * @ref {object} Роутер.
 */
const router = useRouter();

/**
 * @reactive {object} Данные формы.
 */
const formData = reactive({
    login: '',
    // email: '',
    password: ''
});

/**
 * @ref {string | null} Ошибка.
 */
const error = ref(null);

/**
 * Осуществляет авторизацию.
 */
function login() {
    $auth.login(formData)
        // Удачная авторизация.
        .then(() => {
            // Проверяем роль пользователя и редиректим на соответствующие страницы.
            switch ($auth.user.role) {
                case 'user':
                    router.push({
                        name: 'UserProfile'
                    });
                    break;
                case 'admin':
                    router.push({
                        name: 'AdminPanel'
                    });
                    break;
                default:
                    break;
            }
        })
        // Неудачная попытка авторизации.
        .catch((errorLocal) => {
            // Обрабатываем ошибку.
            error.value = errorLocal;
        });
}
</script>

<template>
    <section class="login">
        <h1 class="login__title">Вход</h1>
        <form class="login__form form" @submit.prevent="login">
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': error !== null }" for="login">Логин</label>
                <input class="form__input" :class="{ 'form__input_error': error !== null }" type="text" name="login"
                    id="login" placeholder="Введите имя пользователя" v-model="formData.login">
                <div class="form__error" v-if="error !== null">
                    {{ error }}
                </div>
            </div>

            <div class="form__row">
                <label class="form__label" for="password">Пароль</label>
                <input class="form__input" type="password" name="password" id="password" placeholder="Введите пароль"
                    v-model="formData.password">
            </div>
            <button class="form__btn" type="submit">
                Войти
            </button>
        </form>
    </section>
</template>

<style lang="scss">
.login {
    display: grid;
    grid-template-rows: repeat(2, max-content);
    grid-template-areas: 'title' 'form';

    // .login__title
    &__title {
        @include title;
    }

    // .login__form
    &__form {
        grid-area: form;
    }
}
</style>
