<template>
    <footer class="footer">
        <p class="footer__copyright">&copy; Все права защищены, 2025.</p>
    </footer>
</template>

<style lang="scss">
.footer {
    @include innerContainer;
    padding-top: 1rem;
    padding-bottom: 1rem;
    display: grid;
    justify-items: center;
    align-items: center;
    color: darken($tertiary-color, 10);
    background-color: $secondary-color;
    border-top: 1px solid darken($secondary-color, 10);

    &__copyright {
        font-size: 1.2rem;
    }
}
</style>
