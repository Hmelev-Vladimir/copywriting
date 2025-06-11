<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import $auth from '../../../global/$auth';

/**
 * @ref {object} Роутер.
 */
const router = useRouter();

/**
 * @reactive {object} Данные формы.
 */
const formData = reactive({
    surname: '',
    name: '',
    patronymic: '',
    email: '',
    login: '',
    password: '',
    password_confirmation: ''
});

/**
 * @reactive {object} Ошибки.
 */
const errors = reactive({
    surname: null,
    name: null,
    patronymic: null,
    email: null,
    phone: null,
    login: null,
    password: null
});

/**
 * Осуществляет регистрацию.
 */
function register() {
    $auth.register(formData)
        // Удачная регистрация.
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
        // Неудачная регистрация.
        .catch((serverErrors) => {
            // Обнуляем ошибки.
            for (const property in errors) {
                errors[property] = null;
            }

            // Извлекаем ошибки, которые прислал RegisterRequest.
            for (const property in serverErrors) {
                if (errors.hasOwnProperty(property)) {
                    errors[property] = serverErrors[property][0];
                }
            }
        });
}
</script>

<template>
    <section class="register">
        <h1 class="register__title">Регистрация</h1>
        <form class="register__form form" @submit.prevent="register">
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': errors.surname !== null }"
                    for="surname">Фамилия</label>
                <input class="form__input" :class="{ 'form__input_error': errors.surname !== null }" type="text"
                    name="surname" id="surname" placeholder="Введите фамилию" v-model="formData.surname">
                <div class="form__error" v-if="errors.surname !== null">
                    {{ errors.surname }}
                </div>
            </div>
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': errors.name !== null }" for="name">Имя</label>
                <input class="form__input" :class="{ 'form__input_error': errors.name !== null }" type="text"
                    name="name" id="name" placeholder="Введите имя" v-model="formData.name">
                <div class="form__error" v-if="errors.name !== null">
                    {{ errors.name }}
                </div>
            </div>
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': errors.email !== null }"
                    for="email">Email</label>
                <input class="form__input" :class="{ 'form__input_error': errors.email !== null }" type="email"
                    name="email" id="email" placeholder="Введите адрес электронной почты" v-model="formData.email">
                <div class="form__error" v-if="errors.email !== null">
                    {{ errors.email }}
                </div>
            </div>
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': errors.phone !== null }" for="phone">Номер
                    телефона</label>
                <input class="form__input" :class="{ 'form__input_error': errors.phone !== null }" type="tel"
                    name="phone" id="phone" placeholder="Введите номер телефона" v-model="formData.phone">
                <div class="form__error" v-if="errors.phone !== null">
                    {{ errors.phone }}
                </div>
            </div>
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': errors.login !== null }"
                    for="login">Логин</label>
                <input class="form__input" :class="{ 'form__input_error': errors.login !== null }" type="text"
                    name="login" id="login" placeholder="Введите имя пользователя" v-model="formData.login">
                <div class="form__error" v-if="errors.login !== null">
                    {{ errors.login }}
                </div>
            </div>
            <div class="form__row">
                <label class="form__label" :class="{ 'form__label_error': errors.password !== null }"
                    for="password">Пароль</label>
                <input class="form__input" :class="{ 'form__input_error': errors.password !== null }" type="password"
                    name="password" id="password" placeholder="Введите пароль" v-model="formData.password">
                <div class="form__error" v-if="errors.password !== null">
                    {{ errors.password }}
                </div>
            </div>
            <div class="form__row">
                <label class="form__label" for="password_confirmation">Подтверждение пароля</label>
                <input class="form__input" type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Подтвердите пароль" v-model="formData.password_confirmation">
            </div>
            <button class="form__btn" type="submit">
                Зарегистрироваться
            </button>
        </form>
    </section>
</template>

<style lang="scss">
.register {
    @include card;

    display: grid;
    grid-template-rows: repeat(2, max-content);
    grid-template-areas: 'title' 'form';
    align-self: center;
    justify-self: center;
    min-width: 400px;
    margin-top: 1rem;
    margin-bottom: 1rem;

    &__title {
        @include title;
    }

    &__form {
        grid-area: form;
    }
}
</style>
