<script setup>


const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    errors: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['send-form']);

function uploadImg(event) {
    console.log(event);
    if (event.target.files[0] instanceof File) {
        props.user.pic = event.target.files[0];
    } else {
        props.user.pic = null;
    }
}
</script>

<template>

    <form class="register__form form" @submit.prevent="emit('send-form')">
        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.pic !== null
            }" for="pic">Изображение профиля</label>
            <input class="form__input" :class="{ form__input_error: errors.pic != null }" name="pic" id="pic"
                type="file" accept="image/*" @change="uploadImg">
            <div class="form__error" v-if="errors.pic !== null">{{ errors.pic }}</div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{ 'form__label_error': errors.surname !== null }"
                for="surname">Фамилия</label>
            <input class="form__input" :class="{ 'form__input_error': errors.surname !== null }" type="text"
                name="surname" id="surname" placeholder="Введите фамилию" v-model="user.surname">
            <div class="form__error" v-if="errors.surname !== null">
                {{ errors.surname }}
            </div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{ 'form__label_error': errors.name !== null }" for="name">Имя</label>
            <input class="form__input" :class="{ 'form__input_error': errors.name !== null }" type="text" name="name"
                id="name" placeholder="Введите имя" v-model="user.name">
            <div class="form__error" v-if="errors.name !== null">
                {{ errors.name }}
            </div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{ 'form__label_error': errors.email !== null }" for="email">Email</label>
            <input class="form__input" :class="{ 'form__input_error': errors.email !== null }" type="email" name="email"
                id="email" placeholder="Введите адрес электронной почты" v-model="user.email">
            <div class="form__error" v-if="errors.email !== null">
                {{ errors.email }}
            </div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{ 'form__label_error': errors.phone !== null }" for="phone">Номер
                телефона</label>
            <input class="form__input" :class="{ 'form__input_error': errors.phone !== null }" type="tel" name="phone"
                id="phone" placeholder="Введите номер телефона" v-model="user.phone">
            <div class="form__error" v-if="errors.phone !== null">
                {{ errors.phone }}
            </div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{ 'form__label_error': errors.login !== null }" for="login">Логин</label>
            <input class="form__input" :class="{ 'form__input_error': errors.login !== null }" type="text" name="login"
                id="login" placeholder="Введите имя пользователя" v-model="user.login">
            <div class="form__error" v-if="errors.login !== null">
                {{ errors.login }}
            </div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{ 'form__label_error': errors.password !== null }"
                for="password">Пароль</label>
            <input class="form__input" :class="{ 'form__input_error': errors.password !== null }" type="password"
                name="password" id="password" placeholder="Введите пароль" v-model="user.password">
            <div class="form__error" v-if="errors.password !== null">
                {{ errors.password }}
            </div>
        </div>
        <div class="form__row">
            <label class="form__label" for="password_confirmation">Подтверждение пароля</label>
            <input class="form__input" type="password" name="password_confirmation" id="password_confirmation"
                placeholder="Подтвердите пароль" v-model="user.password_confirmation">
        </div>
        <button class="form__btn" type="submit">
            Изменить профиль
        </button>
    </form>
</template>
