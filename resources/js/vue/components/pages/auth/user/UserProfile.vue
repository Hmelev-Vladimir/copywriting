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
    <section class="profile-container">
        <div class="profile-header">
            <h1>Профиль пользователя</h1>
            <RouterLink class="btn btn-primary" :to="{ name: 'ApplicationCreate' }">
                Создать объявление
            </RouterLink>
        </div>

        <div class="profile-content">
            <div class="profile-image-section">
                <div class="profile-image-wrapper">
                    <img class="profile-image" :src="`${appURL}/storage/${$auth.user.pic}`" :alt="$auth.user.name">
                </div>
                <ProfilePicForm />
            </div>

            <div class="profile-info-section">
                <div class="profile-info-card">
                    <h2>{{ $auth.user.login }}</h2>
                    <div class="info-grid">
                        <div class="info-label">Имя:</div>
                        <div class="info-value">{{ $auth.user.name }}</div>

                        <div class="info-label">Фамилия:</div>
                        <div class="info-value">{{ $auth.user.surname }}</div>

                        <div class="info-label">Телефон:</div>
                        <div class="info-value">{{ $auth.user.phone }}</div>

                        <div class="info-label">Email:</div>
                        <div class="info-value">{{ $auth.user.email }}</div>
                    </div>
                </div>

                <div class="profile-actions">
                    <RouterLink
                        class="btn btn-edit"
                        :to="{ name: 'UserProfileUpdate', params: { id: $auth.user.id } }">
                        Редактировать профиль
                    </RouterLink>
                    <button class="btn btn-danger" type="button" @click="deleteUser">
                        Удалить аккаунт
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss">
.profile-container {
    @include outerContainer;

    margin-top: 1rem;
    margin-bottom: 1rem;
}

.profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;

    h1 {
        @include title;
    }
}

.profile-content {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 2rem;

    @media (max-width: 768px) {
        grid-template-columns: 1fr;
    }
}

.profile-image-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.profile-image-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: center;
}

.profile-image {
    width: 100%;
    max-width: 250px;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
}

.profile-info-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.profile-info-card {
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);

    h2 {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eee;
    }
}

.info-grid {
    display: grid;
    grid-template-columns: 120px 1fr;
    gap: 1rem;

    .info-label {
        font-weight: 600;
        color: #555;
    }

    .info-value {
        color: #333;
    }
}

.profile-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    @include btn;
}

input[type="file"]::file-selector-button {
    border-radius: 4px;
    padding: 0 16px;
    height: 40px;
    cursor: pointer;
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.16);
    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
    margin-right: 16px;
    transition: background-color 200ms;
}

input[type="file"]::file-selector-button:hover {
    background-color: #f3f4f6;
}

input[type="file"]::file-selector-button:active {
    background-color: #e5e7eb;
}
</style>