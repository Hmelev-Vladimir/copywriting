<script setup>
import { onBeforeMount, reactive } from 'vue';
import ApplicationCard from './partials/ApplicationCard.vue';
import axios from 'axios';


const applications = reactive([]);

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
        .finally(() => { console.log('finally'); });
};

onBeforeMount(() => {
    getList();
});


</script>

<template>
    <section class="posts">
        <h1 class="posts__title">Обьявления</h1>
        <div class="posts__container">
            <ApplicationCard v-for="application in applications" :application="application"></ApplicationCard>
        </div>
    </section>
</template>
<style lang="scss">
.posts {
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
        @include title
    }

    // .posts__container

    &__container {
        grid-area: container;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-auto-rows: max-content;
        grid-auto-flow: row;
        gap: 1rem;
    }
}
</style>
