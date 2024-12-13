<script setup>
// Импорт компонентов для хедера и футера.
import VHeader from "./structure/VHeader.vue";
import VFooter from "./structure/VFooter.vue";
</script>

<template>
    <VHeader class="app__header"></VHeader>
    <main class="app__main">
        <RouterView></RouterView>
    </main>
    <VFooter class="app__footer"></VFooter>
</template>
<style lang="scss">
// Универсальный селектор с обнулением базовых стилей.
*,
*::before,
*::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

// Первоначальная разметка.
.app {
    display: grid;
    grid-template-rows:
        max-content 1fr max-content;
    grid-template-areas:
        'header'
        'main'
        'footer';
    min-height: 100vh;

    &__header {
        grid-area: header;
    }

    &__main {
        grid-area: main;
        display: grid;
    }

    &__footer {
        grid-area: footer;
    }
}
</style>
