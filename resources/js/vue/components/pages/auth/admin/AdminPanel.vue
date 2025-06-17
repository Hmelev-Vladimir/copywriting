<template>
    <section class="admin">
        <div class="admin__sidenav">
            <RouterLink :to="{ name: 'ApplicationsAdmin' }">
                Заявки
            </RouterLink>
            <RouterLink :to="{ name: 'UsersAdmin' }">
                Пользователи
            </RouterLink>
        </div>
        <div class="admin__content">
            <RouterView></RouterView>
        </div>
    </section>
</template>

<style lang="scss">
.admin {
    @include outerContainer;
    margin-top: 1rem;
    margin-bottom: 1rem;
    display: grid;
    grid-template-columns: max-content 1fr;
    gap: 1rem;
    grid-template-areas: 'sidenav content';

    &__sidenav {
        height: 100%;
        grid-area: sidenav;
        width: max-content;
        display: flex;
        align-items: center;
        flex-direction: column;
        padding: 1rem;

        background-color: $primary;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    &__content {
        grid-area: content;
    }

    /* The navigation menu links */
    &__sidenav a {
        padding: 8px 8px 8px 8px;
        text-decoration: none;
        font-size: 25px;
        color: $secondary;
        display: block;
    }

    /* When you mouse over the navigation links, change their color */
    &__sidenav a:hover {
        color: $secondary;
        background-color: $accent;
    }




}
</style>
