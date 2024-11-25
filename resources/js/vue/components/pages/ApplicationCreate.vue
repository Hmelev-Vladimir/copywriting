<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import ApplicationForm from './partials/ApplicationForm.vue';


const router = useRouter();
const application = reactive({
    cover: null,
    title: '',
    theme: '',
    price: 0,
    status: '',
    description: '',
    reason: '',
    publicationDate: '',
});
const errors = reactive({
    cover: null,
    title: null,
    theme: null,
    price: null,
    status: null,
    description: null,
    reason: null,
    publicationDate: null,
});

function createApplication() {
    const formData = new FormData();
    formData.append('cover', application.cover);
    formData.append('title', application.title);
    formData.append('theme', application.theme);
    formData.append('price', application.price);
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
    <section class="post-create">
        <h1 class="post-create__title">Новое объявление</h1>
        <ApplicationForm class="post-create__form" :application="application" :errors="errors"
            @send-form="createApplication">
        </ApplicationForm>
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
