<template>
    <footer class="footer">
        <p class="footer__appName">
            {{ appName }}
        </p>
        <p class="footer__copyright">
            &copy; Все права защищены,
            <span class="footer__year">2025</span>
        </p>
    </footer>
</template>

<style lang="scss">
.footer {
    @include innerContainer;

    padding-top: 1rem;
    padding-bottom: 1rem;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    column-gap: 1rem;
    row-gap: 1rem;
    color: $primary;
    background-color: $secondary;
    border-top: 1px solid darken($secondary, 20);
    text-align: center;

    @include mobile {
        flex-direction: column;
    }

    &__appName {
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    &__copyright {
        margin: 0;
        font-size: 1rem;
    }

    &__year {
        display: inline-block;
        padding: 0.125rem 0.25rem;
        border-bottom: 2px solid $accent;
        font-family: initial;
        font-size: 0.9rem;
        font-weight: 600;
    }
}
</style>