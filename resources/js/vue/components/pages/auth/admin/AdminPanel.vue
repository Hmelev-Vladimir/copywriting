<template>
    <section class="admin">
        <h1 class="admin__title">Панель администратора</h1>

        <nav class="admin__sidebar">
            <ul class="admin__menu">
                <li class="admin__menu-item">
                    <RouterLink
                        :to="{ name: 'ApplicationsAdmin' }"
                        class="admin__menu-link"
                        active-class="admin__menu-link--active">
                        <span class="admin__menu-icon"><i class="fas fa-list-alt"></i></span>
                        <span class="admin__menu-text">Заявки</span>
                    </RouterLink>
                </li>
                <li class="admin__menu-item">
                    <RouterLink
                        :to="{ name: 'UsersAdmin' }"
                        class="admin__menu-link"
                        active-class="admin__menu-link--active">
                        <span class="admin__menu-icon"><i class="fas fa-users"></i></span>
                        <span class="admin__menu-text">Пользователи</span>
                    </RouterLink>
                </li>
            </ul>
        </nav>

        <main class="admin__content">
            <RouterView></RouterView>
        </main>
    </section>
</template>

<style lang="scss">
.admin {
    display: grid;
    grid-template-columns: 1fr 3fr;
    grid-template-rows: repeat(2, max-content);
    grid-template-areas:
        'sidebar title'
        'sidebar content';

    @include mobile {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(3, max-content);
        grid-template-areas:
            'title'
            'sidebar'
            'content';
    }

    &__title {
        font-size: 2rem;
        color: $secondary;
        padding-top: 1rem;
        grid-area: title;
        justify-self: stretch;
        text-align: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid $secondary;
        background-color: darken($primary, 5);
    }

    &__sidebar {
        grid-area: sidebar;
        background: $secondary;
        color: $primary;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    &__menu {
        flex: 1;
        padding: 1rem 0;
        list-style: none;
        margin: 0;
    }

    &__menu-item {
        margin: 0.25rem 0;
    }

    &__menu-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        color: rgba($primary, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;

        &:hover {
            background: rgba($primary, 0.05);
            color: $primary;
        }

        &--active {
            background: rgba($primary, 0.1);
            color: $primary;
            border-left: 3px solid $accent;
        }
    }

    &__menu-icon {
        margin-right: 0.75rem;
        width: 20px;
        text-align: center;
    }

    &__menu-text {
        font-size: 0.9rem;
    }

    &__content {
        grid-area: content;
        flex: 1;
        padding: 2rem;
        overflow-y: auto;
        background-color: $primary;
    }
}
</style>