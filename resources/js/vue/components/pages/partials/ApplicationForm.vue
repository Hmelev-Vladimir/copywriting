<script setup>
// Входные данные компонента.
const props = defineProps({
    application: {
        type: Object,
        required: true,
    },
    errors: {
        type: Object,
        required: true,
    },
});

// Излучатель.
const emit = defineEmits(['send-form']);

/**
 * Управляет получением изображения из поля ввода.
 */
function uploadImg(event) {
    console.log(event);
    if (event.target.files[0] instanceof File) {
        props.application.cover = event.target.files[0];
    } else {
        props.application.cover = null;
    }
}
</script>

<template>
    <form class="form" @submit.prevent="emit('send-form')">

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.cover !== null
            }" for="cover">Обложка</label>
            <input class="form__input" :class="{ form__input_error: errors.cover != null }" name="cover" id="cover"
                type="file" accept="image/*" @change="uploadImg">
            <div class="form__error" v-if="errors.cover !== null">{{ errors.cover }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.title !== null
            }" for="title">Заголовок</label>
            <input class="form__input" :class="{ form__input_error: errors.title != null }" name="title" id="title"
                type="text" v-model="application.title">
            <div class="form__error" v-if="errors.title !== null">{{ errors.title }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.theme !== null
            }" for="theme">Тема</label>
            <textarea class="form__input" :class="{ form__input_error: errors.theme != null }" name="theme" id="theme"
                type="text" v-model="application.theme"></textarea>
            <div class="form__error" v-if="errors.theme !== null">{{ errors.theme }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.price !== null
            }" for="price">Цена</label>
            <input class="form__input" :class="{ form__input_error: errors.price != null }" name="price" id="price"
                type="number" v-model="application.price">
            <div class="form__error" v-if="errors.price !== null">{{ errors.price }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.status !== null
            }" for="status">Статус</label>
            <select class="form__input" :class="{ form__input_error: errors.price != null }" name="status" id="status"
                v-model="application.status">
                <option>Новая</option>
                <option>Опубликовано</option>
                <option>На модерации</option>
                <option>В архиве</option>
                <option>Откликнулись</option>
                <option>Куплено</option>
            </select>
            <div class="form__error" v-if="errors.status !== null">{{ errors.status }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.description !== null
            }" for="description">Описание</label>
            <textarea class="form__input" :class="{ form__input_error: errors.description != null }" name="description"
                id="description" type="text" rows="10" v-model="application.description"></textarea>
            <div class="form__error" v-if="errors.description !== null">{{ errors.description }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.publicationDate !== null
            }" for="publicationDate">Дата</label>
            <input class="form__input" :class="{ form__input_error: errors.publicationDate != null }"
                name="publicationDate" id="publicationDate" type="datetime-local" v-model="application.publicationDate"
                step="1">
            <div class="form__error" v-if="errors.publicationDate !== null">{{ errors.publicationDate }}</div>
        </div>

        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.text !== null
            }" for="text">Текст выполненной работы</label>
            <textarea class="form__input" :class="{ form__input_error: errors.text != null }" name="text"
                id="text" type="text" v-model="application.text" rows="10"></textarea>
            <div class="form__error" v-if="errors.text !== null">{{ errors.text }}</div>
        </div>

        <button class="form__btn" type="submit">Сохранить</button>

    </form>
</template>
