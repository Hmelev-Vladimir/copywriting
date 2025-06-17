<script setup>
import { onBeforeMount, reactive, ref } from 'vue';
import ApplicationCard from './ApplicationCard.vue';
import axios from 'axios';


const applications = reactive([]);
const load = ref(true);

function getList() {
    axios.get('/api/applications/getList', { params: {} })
        .then((response) => {
            console.log(response);
            applications.splice(0, applications.length);
            applications.push(...response.data.applications);
        })
        .catch((error) => {
            console.log(error.response);
        })
        .finally(() => { load.value = false; });
};


function deleteApplication(application) {
    if (confirm('Хотите удалить данную заявку?')) {
        axios.delete('/api/applications/delete', { params: { id: application.id } })
            .then((response) => {
                console.log(response);
                const index = applications.indexOf(application);
                applications.splice(index, 1);
            }).catch((error) => {
                console.log(error.response);
                alert('Ошибка! Заявки с подобным id не существует.');
            });

    }
}

onBeforeMount(() => {
    getList();
});
</script>

<template>
    <section class="adminApplications">
        <h1 class="adminApplications__title">Заявки</h1>
        <div class="adminApplications__container" v-if="!load">
            <ApplicationCard v-for="application in applications" :application="application"
                @deleteApplication="deleteApplication">
            </ApplicationCard>
        </div>
        <div class="adminApplications__container adminApplications__container_load" v-else>
            <Load></Load>
        </div>
    </section>
</template>
<style lang="scss">
.adminApplications {
    @include outerContainer;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, max-content);
    grid-template-areas:
        'title btn'
        'container container';
    ;
    // .posts__title

    &__title {

        grid-area: title;
        @include title;
        justify-self: start;
    }

    // .posts__container
    &__btn {
        grid-area: btn;
        @include btn;
        margin-bottom: 10px;
        font-size: 15pt;
        text-align: center;
    }

    &__container {
        grid-area: container;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;

        &_load {
            grid-template-columns: 1fr;
            justify-items: center;
        }
    }


}
</style>
