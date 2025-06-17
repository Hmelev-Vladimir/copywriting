<script setup>
import Logout from '../pages/auth/partials/Logout.vue';
</script>

<template>
    <header class="header">
        <!-- Логотип -->
        <RouterLink class="header__logo-link"
            :to="{ name: 'Main' }"
            :title="appName">
            <img class="header__logo" src="/images/logo3.png" :alt="appName">
        </RouterLink>
        <!-- Навигационные панели -->
        <div class="header__navbars">
            <!-- Навигационная панель (верхняя) -->
            <nav class="header__nav-upper">
                <ul class="header__list-upper">
                    <!-- Только для НЕавторизованного пользователя -->
                    <template v-if="$auth.user.role === 'guest'">
                        <li>
                            <RouterLink class="header__link-upper" :to="{ name: 'Register' }">
                                Регистрация
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink class="header__link-upper" :to="{ name: 'Login' }">
                                Вход
                            </RouterLink>
                        </li>
                    </template>
                    <!-- Только для авторизованного пользователя -->
                    <template v-else>
                        <li>
                            <Logout></Logout>
                        </li>
                    </template>
                </ul>
            </nav>
            <!-- Навигационная панель (нижняя) -->
            <nav class="header__nav-lower">
                <ul class="header__list-lower">
                    <li>
                        <RouterLink class="header__link-lower" :to="{ name: 'Main' }">
                            Главная
                        </RouterLink>
                    </li>
                    <!-- Только для пользователя с ролью user -->
                    <template v-if="$auth.user.role === 'user'">
                        <li>
                            <RouterLink class="header__link-lower" :to="{ name: 'Applications' }">
                                Заявки
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink class="header__link-lower" :to="{ name: 'UserProfile' }">
                                Профиль
                            </RouterLink>
                        </li>
                    </template>
                    <!-- Только для пользователя с ролью admin -->
                    <template v-else-if="$auth.user.role === 'admin'">
                        <li>
                            <RouterLink class="header__link-lower" :to="{ name: 'AdminPanel' }">
                                Панель администратора
                            </RouterLink>
                        </li>
                    </template>
                </ul>
                <ul class="header__list-lower header__list-lower_end">
                    <li v-if="$auth.user.role !== 'guest'">
                        <span class="header__user-container">
                            <img class="header__user-pic"
                                :src="`${appURL}/storage/${$auth.user.pic}`"
                                :alt="$auth.user.name">
                            <span>{{ $auth.user.login }}</span>
                        </span>
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
    align-content: center;
    gap: 2rem;
    overflow: hidden;
    color: $primary;
    background-color: $secondary;
    box-shadow: -3px 0 3px 1px $accent;
    position: relative;
    z-index: 50;

    @include mobile {
        padding-top: 1rem;
        padding-bottom: 1rem;
        grid-template-columns: 1fr;
        grid-template-rows: repeat(2, max-content);
        grid-template-areas:
            'logo-link'
            'navbars';
        justify-items: center;
        gap: 1rem;
    }

    &__logo-link {
        grid-area: logo-link;
    }

    &__logo {
        height: 3rem;
        object-fit: contain;
    }

    &__navbars {
        grid-area: navbars;
        display: grid;
        grid-template-rows: repeat(2, max-content);
        grid-template-areas:
            'nav-upper'
            'nav-lower';
        gap: 0.5rem;
    }

    &__nav-upper {
        grid-area: nav-upper;
        display: grid;
        justify-content: end;

        @include mobile {
            justify-content: center;
        }
    }

    &__nav-lower {
        grid-area: nav-lower;
        display: grid;
        grid-template-columns: 1fr max-content;
        justify-content: space-between;

        @include mobile {
            grid-template-columns: 1fr;
            justify-content: center;
        }
    }

    &__list-upper,
    &__list-lower {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
        list-style-type: none;
        align-items: center;
        position: relative;

        @include mobile {
            flex-direction: column;
        }

        &_end {
            justify-content: end;
        }
    }

    &__link-upper,
    &__link-lower {
        display: inline-block;
        color: inherit;
        text-decoration: none;
        cursor: pointer;
        border: none;
        outline: none;
        transition: all 0.5s ease-in-out;
    }

    &__link-upper {
        position: relative;
        top: -0.25rem;
        padding: 0.75rem 1rem 0.5rem 1rem;
        color: $primary;
        background-color: $accent;
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;

        &:hover,
        &:focus {
            color: $accent;
            background-color: $primary;
            transform: translateY(0.25rem);
        }

        @include mobile {
            padding: 0.75rem 1rem 0.75rem 1rem;
            top: 0;
            border-radius: 0.5rem;

            &:hover,
            &:focus {
                color: $accent;
                background-color: $primary;
                transform: translateX(0.25rem);
            }
        }
    }

    &__link-lower {
        position: relative;
        bottom: -0.5rem;
        padding: 0.5rem 1.5rem 1rem 1.5rem;
        color: $primary;
        background-color: darken($secondary, 20);
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 600;

        &:hover,
        &:focus {
            color: darken($secondary, 20);
            background-color: $primary;
            transform: translateY(-0.25rem);
        }

        @include mobile {
            padding: 0.5rem 1.5rem 0.5rem 1.5rem;
            bottom: 0;
            border-radius: 0.5rem;
        }
    }

    &__user-container {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        align-items: center;
        margin-top: 0.5rem;
        padding: 0.5rem;
    }

    &__user-pic {
        width: 1.5rem;
        height: 1.5rem;
        object-fit: cover;
        border-radius: 50%;
    }
}
</style>
