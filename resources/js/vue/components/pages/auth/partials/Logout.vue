<script setup>
import { useRouter } from 'vue-router';
import $auth from '#/$auth';

/**
 * @ref {object} Роутер.
 */
const router = useRouter();

/**
 * Осуществляет выход.
 */
function logout() {
    $auth.logout()
        // Успешный выход.
        .then(() => {
            // Редирект на стартовую страницу.
            router.push({ name: 'Main' });
        });
}
</script>

<template>
    <button class="header__link-upper" @click="logout">
        Выйти
    </button>
</template>
