<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import ApplicationForm from './partials/ApplicationForm.vue';

// Роутер.
const router = useRouter();

// Заявка.
const application = reactive({
    cover: null,
    title: '',
    theme: '',
    price: 0,
    status: '',
    description: '',
    text: '',
    publicationDate: '',
});

// Ошибки.
const errors = reactive({
    cover: null,
    title: null,
    theme: null,
    price: null,
    status: null,
    text: null,
    description: null,
    publicationDate: null,
});

/**
 * Создает заявку.
 */
function createApplication() {
    const formData = new FormData();
    formData.append('cover', application.cover);
    formData.append('title', application.title);
    formData.append('theme', application.theme);
    formData.append('price', application.price);
    formData.append('status', application.status);
    formData.append('text', application.text);
    formData.append('description', application.description);
    formData.append('publicationDate', application.publicationDate);

    axios.post('api/applications/create', formData)
        .then((response) => {
            console.log(response);
            router.push({ name: 'Applications' });
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
</script>

<template>
    <div class="breadcrumbs">
        <RouterLink
            :to="{ name: 'Applications'}">
            Заявки
        </RouterLink>
        <span>➤</span>
        <span>Создание заявки</span>
    </div>

    <section class="application-create">
        <h1 class="application-create__title">Создание заявки</h1>
        <ApplicationForm class="application-create__form" :application="application" :errors="errors"
            @send-form="createApplication">
        </ApplicationForm>
    </section>
</template>

<style lang="scss">
.application-create {
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
