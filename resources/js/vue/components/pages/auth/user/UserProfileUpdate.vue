<script setup>
import { reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import ProfileForm from './partials/ProfileForm.vue';
import $auth from '#/$auth';

const props = defineProps({
    id: {
        type: [String, Number],
        default: 0
    }
});

const router = useRouter();

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

function copyUser() {
    user.id = $auth.user.id;
    user.login = $auth.user.login;
    user.surname = $auth.user.surname;
    user.pic = $auth.user.pic;
    user.name = $auth.user.name;
    user.phone = $auth.user.phone;
    user.email = $auth.user.email;
    user.password = '';
    user.password_confirmation = '';
}

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

    axios.post('api/user/update', formData)
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
    copyUser();
});
</script>

<template>
    <section class="post-create">
        <h1 class="post-create__title" v-once>{{ $auth.user.login }}</h1>
        <ProfileForm class="post-create__form" :user="user" :errors="errors" @send-form="updateProfile">
        </ProfileForm>
    </section>

</template>
<style lang="scss">
.post-create {
    @include outerContainer;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: grid;
    grid-template-rows: repeat(2, max-content);
    grid-template-areas:
        'title'
        'form';
    gap: 1rem;

    &__title {
        grid-area: title;
        @include title;
    }

    &__form {
        grid-area: form;
    }
}
</style>
