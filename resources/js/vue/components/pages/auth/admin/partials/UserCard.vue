<script setup>
// Входные данные компонента.
const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

// Излучатель.
const emit = defineEmits(['deleteUser']);
</script>

<template>
    <article class="user-card">
        <div class="user-card__content">
            <img class="user-card__avatar" :src="`${appURL}/storage/${user.pic}`" :alt="user.name">
            <div class="user-card__info">
                <h3 class="user-card__login">{{ user.login }}</h3>
                <p class="user-card__name">{{ user.name }}</p>
                <p class="user-card__surname">{{ user.surname }}</p>
            </div>
        </div>
        <div class="user-card__actions">
            <RouterLink class="user-card__action user-card__btn"
                       :to="{ name: 'UserProfileUpdate', params: { id: user.id } }">
                Редактировать
            </RouterLink>
            <button class="user-card__action user-card__btn"
                    type="button"
                    @click="emit('deleteUser', user)"
                    v-if="user.id !== $auth.user.id">
                Удалить
            </button>
        </div>
    </article>
</template>

<style lang="scss">
.user-card {
    @include card;

    display: flex;
    flex-direction: column;
    gap: 1rem;

    @include mobile {
        padding: 0.75rem;
    }

    &__content {
        display: grid;
        grid-template-columns: 100px 1fr;
        gap: 1rem;
        align-items: center;

        @include mobile {
            grid-template-columns: 80px 1fr;
            gap: 0.75rem;
        }
    }

    &__avatar {
        width: 100px;
        height: 100px;
        border-radius: 15px;
        object-fit: cover;
        object-position: center;

        @include mobile {
            width: 80px;
            height: 80px;
        }
    }

    &__info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.5rem;
        align-items: center;

        @include mobile {
            grid-template-columns: 1fr;
            gap: 0.25rem;
        }
    }

    &__login {
        margin: 0;
        font-size: 1rem;
        color: $secondary;
        font-weight: 600;
    }

    &__name,
    &__surname {
        margin: 0;
        color: $secondary;
        opacity: 0.8;
    }

    &__actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid rgba($secondary, 0.1);

        @include mobile {
            flex-direction: column;
        }
    }

    &__btn {
        @include btn;
    }
}
</style>