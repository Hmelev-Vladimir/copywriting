<script setup>
const props = defineProps({
    application: {
        type: Object,
        required: true
    },
    errors: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['send-form']);

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
            }" for="theme">Тема объявления</label>
            <textarea class="form__input" :class="{ form__input_error: errors.theme != null }" name="theme" id="theme"
                type="text" v-model="application.theme"></textarea>
            <div class="form__error" v-if="errors.theme !== null">{{ errors.theme }}</div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.price !== null
            }" for="likeCounter">Цена</label>
            <input class="form__input" :class="{ form__input_error: errors.price != null }" name="price" id="price"
                type="number" v-model="application.price">
            <div class="form__error" v-if="errors.price !== null">{{ errors.price }}</div>
        </div>
        <div class="form__row">
            <label class="form__label" :class="{
                form__label_error: errors.description !== null
            }" for="description">Описание объявления</label>
            <textarea class="form__input" :class="{ form__input_error: errors.description != null }" name="description"
                id="description" type="text" v-model="application.description"></textarea>
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
        <button class="form__btn" type="submit">Сохранить</button>
    </form>
</template>
