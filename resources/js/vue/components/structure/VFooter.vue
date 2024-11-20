<template>
    <footer class="footer">
        <p class="footer__copyright">&copy; Все права защищены, 2024.</p>
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
    color: $teriary-color;
    background-color: $secondary-color;

    &__copyright {
        font-size: 1.2rem;
    }
}
</style>
