<script setup>
import { reactive, computed, onBeforeMount } from 'vue';
import { useRouter } from 'vue-router';

const props = defineProps({
    id: {
        type: [String, Number],
        default: 0
    }
});

const router = useRouter();

const application = reactive({
    id: -1,
    cover: '',
    title: '',
    theme: '',
    price: '',
    status: '',
    reason: '',
    description: '',
    publicationDate: '',
    created_at: '',
    updated_at: '',
    user: { surname: '' },
});

function getApplication() {
    axios.get('/api/applications/getApplication', { params: { id: props.id } })
        .then((response) => {
            console.log(response);
            for (const key in response.data.application) {
                application[key] = response.data.application[key];
            }
        })
        .catch((error) => {
            console.log(error.response);
            alert(`Ошибка ${error.response.status}`);
            router.push({ name: 'Applications' });
        });
}

onBeforeMount(() => {
    getApplication();
});

</script>

<template>
    <div class="applicationShow">
        <img class="applicationShow__cover" :src="`/storage/${application.cover}`" :alt="application.title">
        <div class="applicationShow__item">
            <h1 class="applicationShow__title"> {{ application.title }} </h1>
            <p class="applicationShow__theme">Тема: {{ application.theme }}</p>
            <p class="applicationShow__price">{{ application.price }} РУБ</p>
            <p class="applicationShow__price">Автор: {{ application.user.surname }}</p>
            <p class="applicationShow__description">{{ application.description }}</p>
            <p class="applicationShow__status"> Статус объявления: {{ application.status }} </p>
            <div class="applicationShow__dateCont">
                <div class="applicationShow__publicationDate">Обупликовано в: {{ new
                    Date(application.publicationDate).toLocaleString() }}
                </div>
                <div class="applicationShow__created-at">Созданно в: {{ new
                    Date(application.created_at).toLocaleString() }}
                </div>
                <div class="applicationShow__updated-at">Изменнено в {{ new
                    Date(application.updated_at).toLocaleString() }}
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
.applicationShow {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-areas: 'cover content';
    @include outerContainer;
    margin-top: 1rem;
    margin-bottom: 1rem;
    gap: 0.6rem;
    color: $secondary;
    // .applicationShow__cover

    &__cover {
        height: 500px;
        width: 100%;
        object-fit: cover;
        grid-area: cover;
    }

    // .applicationShow__item

    &__item {
        grid-area: content;
        display: grid;
        grid-template-rows: auto;
        grid-auto-flow: row;
        gap: 1rem;
        margin-left: 0.5rem;
    }

    // .applicationShow__title
    &__description {
        text-align: center;
        font-size: 1.5rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        @include innerContainer;
    }

    &__title {
        text-align: center;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        padding-top: 50px;
    }

    // .applicationShow__theme

    &__theme {
        display: grid;
        padding-top: 50px;
        grid-template-columns: auto;
        grid-auto-flow: column;
        text-align: center;
        gap: 2rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        font-size: 15pt;
    }

    // .applicationShow__price

    &__price {
        text-align: center;
        padding-top: 50px;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
        font-size: 1.5rem;

    }

    // .applicationShow__status

    &__status {
        text-align: center;
        padding-top: 50px;
        font-size: 1.5rem;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
    }

    // .applicationShow__publicationDate

    // .applicationShow__dateCont

    &__dateCont {
        display: grid;
        grid-template-columns: auto;
        grid-auto-flow: column;
        text-align: center;
        gap: 2rem;

    }

    // .applicationShow__created-at
    &__publicationDate {
        padding-top: 30px;

        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
    }

    &__created-at {
        padding-top: 30px;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
    }

    // .applicationShow__updated-at

    &__updated-at {
        padding-top: 30px;
        box-shadow: 0px 3px 3px 0px $primary;
        border-radius: 15px;
    }
}
</style>
