<script setup>
import { reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import ProfileForm from './partials/ProfileForm.vue';
import $auth from '#/$auth';

// Входные данные компонента.
const props = defineProps({
    id: {
        type: [String, Number],
        default: 0
    }
});

// Роутер.
const router = useRouter();

// Пользователь.
const user = reactive({
    id: -1,
    login: '',
    surname: '',
    pic: null,
    name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

// Ошибки.
const errors = reactive({
    id: null,
    login: null,
    surname: null,
    pic: null,
    name: null,
    phone: null,
    email: null,
    password: null,
});

/**
 * Получает пользователя.
 */
function getUser() {
    axios.get('/api/users/getUser', { params: { id: props.id } })
        .then((response) => {
            console.log(response);
            for (const key in response.data.user) {
                user[key] = response.data.user[key];
            }
        })
        .catch((error) => {
            console.log(error.response);
            alert(`Ошибка ${error.response.status}`);
            if ($auth.user.role === 'admin') {
                router.push({ name: 'UsersAdmin' });

            } else if ($auth.user.role === 'user') {
                router.push({ name: 'UserProfile' });
            }
        });
}

/**
 * Обновляет профиль.
 */
function updateProfile() {
    const formData = new FormData();
    formData.append('id', user.id);
    formData.append('pic', user.pic);
    formData.append('name', user.name);
    formData.append('surname', user.surname);
    formData.append('login', user.login);
    formData.append('phone', user.phone);
    formData.append('email', user.email);
    formData.append('password', user.password);
    formData.append('password_confirmation', user.password_confirmation);

    axios.post('api/users/update', formData)
        .then((response) => {
            console.log(response);
            router.push({ name: 'UserProfile' });
        })
        .catch((error) => {
            for (const key in errors) {
                errors[key] = null;
            }
            console.log(error.response);
            if (error.response.status === 422) {
                for (const key in error.response.data.errors) {
                    if (errors.hasOwnProperty(key)) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                }
            }
        });
}

onMounted(() => {
    getUser();
});
</script>

<template>
    <div class="breadcrumbs">
        <RouterLink
            :to="{ name: 'UserProfile' }">
            Профиль
        </RouterLink>
        <span>➤</span>
        <span>Редактирование профиля</span>
    </div>

    <section class="user-profile-update">
        <h1 class="user-profile-update__title">
            Редактирование профиля
        </h1>
        <ProfileForm class="user-profile-update__form"
            :user="user"
            :errors="errors"
            @send-form="updateProfile">
        </ProfileForm>
    </section>
</template>

<style lang="scss">
.user-profile-update {
    @include outerContainer;
    @include card;

    margin-top: 1rem;
    margin-bottom: 1rem;
    display: grid;
    grid-template-rows: repeat(2, max-content);
    grid-template-areas:
        'title'
        'form';
    gap: 1rem;

    &__title {
        @include title;
        grid-area: title;
    }

    &__form {
        grid-area: form;
    }
}
</style>
