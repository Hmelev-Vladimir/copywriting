<template>
    <header class="header">
        <RouterLink class="header__logo-link" :to="{ name: 'Main' }">
            <!-- Пример подключения логотипа. -->
            <!-- Логотип должен находиться в папке public/images. -->
            <img class="header__logo" src="/images/logo.png" alt="Название приложения">
        </RouterLink>
        <nav class="header__nav">
            <ul class="header__list">
                <!-- Пример подключения ссылки. -->
                <li>
                    <RouterLink class="header__link" :to="{ name: 'Main' }">
                        Главная
                    </RouterLink>
                </li>
                <li>
                    <RouterLink class="header__link" :to="{ name: 'Applications' }">
                        Объявления
                    </RouterLink>
                </li>
                <li>
                    <RouterLink class="header__link" :to="{ name: 'Main' }">
                        Главная
                    </RouterLink>
                </li>
                <li>
                    <RouterLink class="header__link" :to="{ name: 'Main' }">
                        Главная
                    </RouterLink>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style lang="scss">
.header {
    padding-top: 1rem;
    padding-bottom: 1rem;
    display: grid;
    grid-template-columns: max-content 1fr;
    grid-template-areas: 'logo-link nav';
    align-items: center;
    gap: 2rem;
    align-content: center;
    background-color: $teriary-color;
    color: $primary-color;
    border: 3px solid $primary-color;
    @include innerContainer; // .header__log-link

    &__logo-link {
        grid-area: logo-link;
        background-color: $secondary-color;
        border: 1px solid $secondary-color;
        border-radius: 15px;
    }

    // .header__logo

    &__logo {
        width: 50px;
        transition: transform 0.2s ease-in-out;

        &:hover {
            transform: scale(1.1);
        }
    }

    // .header__nav

    &__nav {
        grid-area: nav;

    }

    // .header__list

    &__list {
        list-style-type: none;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 30px;
    }

    // .header__link

    &__link {
        display: inline;
        color: $secondary-color;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        margin-top: 50px;
        padding: 15px;
        border: solid 3px $primary-color;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        background-color: $primary-color;
        font-weight: bold;
        font-size: 15pt;


        &:hover {
            color: $secondary-color;
            border: solid 3px $secondary-color;
            background-color: $primary-color;
        }
    }
}
</style>
