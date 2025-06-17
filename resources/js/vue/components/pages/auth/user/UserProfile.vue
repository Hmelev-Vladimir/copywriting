<script setup>
import { useRouter } from 'vue-router';
import $auth from '#/$auth';
import ProfilePicForm from './partials/ProfilePicForm.vue';

// Роутер.
const router = useRouter();

/**
 * Удаляет пользователя.
 */
function deleteUser() {
    if (confirm('Хотите удалить свой аккаунт?')) {
        axios.delete('/api/users/delete', { params: { id: $auth.user.id } })
            .then((response) => {
                console.log(response);
                $auth.token.removeLocal();
                $auth.user.removeLocal();
                router.push({ name: 'Main' });
            }).catch((error) => {
                console.log(error.response);
                alert('Ошибка! Пользователя с подобным id нет');
            });
    }
};
</script>

<template>
    <section class="profile">
        <div class="profile__header">
            <h1 class="profile__title">Профиль</h1>
            <RouterLink class="profile__button" :to="{ name: 'ApplicationCreate' }">
                Создать заявку
            </RouterLink>
        </div>

        <div class="profile__content">
            <div class="profile__image-section">
                <div class="profile__image-container">
                    <img class="profile__avatar"
                        :src="`${appURL}/storage/${$auth.user.pic}`" :alt="$auth.user.name">
                </div>
                <ProfilePicForm class="profile__form"></ProfilePicForm>
            </div>

            <div class="profile__info-section">
                <div class="profile__info">
                    <h2 class="profile__username">{{ $auth.user.login }}</h2>
                    <div class="profile__grid">
                        <span class="profile__label">Имя:</span>
                        <span class="profile__value">{{ $auth.user.name }}</span>

                        <span class="profile__label">Фамилия:</span>
                        <span class="profile__value">{{ $auth.user.surname }}</span>

                        <span class="profile__label">Телефон:</span>
                        <span class="profile__value">{{ $auth.user.phone }}</span>

                        <span class="profile__label">Email:</span>
                        <span class="profile__value">{{ $auth.user.email }}</span>
                    </div>
                </div>

                <div class="profile__actions">
                    <RouterLink
                        class="profile__button"
                        :to="{ name: 'UserProfileUpdate', params: { id: $auth.user.id } }">
                        Редактировать профиль
                    </RouterLink>
                    <button class="profile__button" type="button" @click="deleteUser">
                        Удалить аккаунт
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss">
.profile {
    @include outerContainer;

    margin-top: 1rem;
    margin-bottom: 1rem;

    &__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    &__title {
        @include title;
        margin: 0;
    }

    &__content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;

        @include mobile {
            grid-template-columns: 1fr;
        }
    }

    &__image-section {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    &__image-container {
        display: flex;
        justify-content: center;
    }

    &__avatar {
        width: 100%;
        height: auto;
        border-radius: 0.5rem;
        object-fit: cover;
    }

    &__info-section {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    &__info {
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px $secondary;
    }

    &__username {
        font-size: 1.5rem;
        color: $secondary;
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
    }

    &__grid {
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 1rem;
    }

    &__label {
        font-weight: 600;
        color: $secondary;
    }

    &__value {
        color: $secondary;
    }

    &__actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    &__button {
        @include btn;
    }
}
</style>