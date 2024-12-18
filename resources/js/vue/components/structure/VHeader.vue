<script setup>
import Logout from '../pages/auth/partials/Logout.vue';

</script>
<template>
    <header class="header">
        <RouterLink class="header__logo-link" :to="{ name: 'Main' }">
            <!-- Пример подключения логотипа. -->
            <!-- Логотип должен находиться в папке public/images. -->
            <img class="header__logo" src="/images/logo.png" alt="Название приложения">
        </RouterLink>
        <div class="header__navbars">
            <nav class="header__nav-lower">
                <ul class="header__list">
                    <li v-if="$auth.user.role === 'guest'">
                        <RouterLink class="header__link" :to="{ name: 'Register' }">
                            Регистрация
                        </RouterLink>
                    </li>
                    <li v-if="$auth.user.role === 'guest'">
                        <RouterLink class="header__link" :to="{ name: 'Login' }">
                            Вход
                        </RouterLink>
                    </li>
                    <li v-if="$auth.user.role !== 'guest'">
                        <Logout></Logout>
                    </li>
                </ul>
            </nav>
            <nav class="header__nav-upper">
                <ul class="header__list-up">
                    <!-- Пример подключения ссылки. -->

                    <li>
                        <RouterLink class="header__link-up" :to="{ name: 'Main' }">
                            Главная
                        </RouterLink>
                    </li>
                    <li v-if="$auth.user.role === 'user'">
                        <RouterLink class="header__link-up" :to="{ name: 'Applications' }">
                            Объявления
                        </RouterLink>
                    </li>
                    <li v-if="$auth.user.role === 'admin'">
                        <RouterLink class="header__link-up" :to="{ name: 'AdminPanel' }">
                            Панель администратора
                        </RouterLink>
                    </li>
                    <li v-if="$auth.user.role === 'user'">
                        <RouterLink class="header__link-up" :to="{ name: 'UserProfile' }">
                            Профиль пользователя
                        </RouterLink>
                    </li>
                </ul>
                <ul class="header__list-up_second">
                    <li v-if="$auth.user.role === 'user'">
                        <div class="header__container">
                            <img class="header__userPic" :src="`/storage/${$auth.user.pic}`" :alt="$auth.user.name">
                            <p class="header__h2">{{ $auth.user.login }}</p>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<style lang="scss">
.header {
    @include innerContainer;
    display: grid;
    grid-template-columns: max-content 1fr;
    grid-template-areas: 'logo-link navbars';
    align-items: center;
    gap: 2rem;
    align-content: center;
    background-color: $primary-color;

    @include mobile {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(2, max-content);
        grid-template-areas: 'logo-link' 'navbars';
        gap: 1rem;
        justify-items: center;
    }

    &__logo-link {
        grid-area: logo-link;

    }

    &__navbars {
        display: grid;
        grid-template-rows: max-content max-content;
        grid-auto-flow: row;
        grid-template-areas: 'nav-upper' 'nav-lower';
        grid-area: navbars;
        gap: 1rem;
    }



    // .header__container

    &__container {
        display: grid;
        grid-template-columns: repeat(2, max-content);
        grid-template-areas:
            'pic info';
        padding: 5px;

    }

    // .header__userPic

    &__userPic {
        width: 50px;
        grid-area: pic;
        border-radius: 15px;
    }

    // .header__h2

    &__h2 {
        padding-top: 10px;
        margin-left: 10px;
        grid-area: info;
        font-size: 15pt;
        text-align: center;

    }



    &__logo {
        width: 150px;
        transition: transform 0.2s ease-in-out;


        filter: brightness(0) saturate(100%) invert(49%) sepia(67%) saturate(783%) hue-rotate(326deg) brightness(99%) contrast(89%);
        border-radius: 15px;


        &:hover {
            transform: scale(1.1);
        }
    }

    // .header__nav
    &__nav-lower {
        grid-area: nav-lower;
        align-self: end;

    }

    &__nav-upper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-areas: 'list list2';
        margin-right: calc(max(50px, 5%) * -1);
        grid-area: nav-upper;
        align-self: start;
        background-color: $secondary-color;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    &__list-up {
        grid-area: list;
        list-style-type: none;

        padding-bottom: 20px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: top;

        @include mobile {
            flex-direction: column;
            align-self: center;
        }
    }

    &__list-up_second {
        display: grid;
        grid-area: list2;
        justify-content: end;
        list-style-type: none;
    }

    // .header__list

    &__list {
        list-style-type: none;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;


        @include mobile {
            flex-direction: column;
            align-self: center;
        }
    }

    // .header__link
    &__link-up {
        font-size: 12pt;
        color: $teriary-color;
        text-decoration: none;
        margin-left: 5px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        transition: all 0.2s ease-in-out;
        background: transparent;
        cursor: pointer;
        border: 2px solid $teriary-color;
        padding: 15px;
        display: inline-block;

        &:hover {
            background-color: $teriary-color;
            color: $secondary-color;
        }
    }

    &__link {
        display: inline-block;
        color: $secondary-color;
        background-color: $teriary-color;
        border: 3px solid $teriary-color;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        background-color: $teriary-color;
        padding: 15px;
        font-size: 14pt;

        &:hover {
            background-color: $secondary-color;
            color: $teriary-color;
        }
    }
}
</style>
