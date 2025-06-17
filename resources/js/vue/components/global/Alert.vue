<template>
    <transition name="fade">
      <div v-if="isVisible" class="success-alert">
        <div class="success-alert__content">
          <div class="success-alert__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
          </div>
          <div class="success-alert__message">
            <slot>Действие успешно выполнено!</slot>
          </div>
          <button v-if="closable" @click="close" class="success-alert__close">
            &times;
          </button>
        </div>
      </div>
    </transition>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'

  const props = defineProps({
    // Автоматическое закрытие через указанное время (мс)
    autoClose: {
      type: Number,
      default: 0 // 0 - не закрывается автоматически
    },
    // Показывать ли кнопку закрытия
    closable: {
      type: Boolean,
      default: true
    },
    // Показывать алерт сразу при монтировании
    showOnMount: {
      type: Boolean,
      default: true
    }
  })

  const emit = defineEmits(['close', 'open'])

  const isVisible = ref(false)

  const show = () => {
    isVisible.value = true
    emit('open')

    if (props.autoClose > 0) {
      setTimeout(() => close(), props.autoClose)
    }
  }

  const close = () => {
    isVisible.value = false
    emit('close')
  }

  onMounted(() => {
    if (props.showOnMount) {
      show()
    }
  })

  // Экспортируем методы для использования извне
  defineExpose({
    show,
    close
  })
  </script>

  <style scoped>
  .success-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    max-width: 400px;
    display: flex;
    align-items: center;
  }

  .success-alert__content {
    display: flex;
    align-items: center;
    width: 100%;
  }

  .success-alert__icon {
    margin-right: 12px;
    flex-shrink: 0;
  }

  .success-alert__icon svg {
    width: 24px;
    height: 24px;
    color: #22c55e;
  }

  .success-alert__message {
    flex-grow: 1;
    font-size: 14px;
    line-height: 1.5;
  }

  .success-alert__close {
    margin-left: 12px;
    background: none;
    border: none;
    color: #166534;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    line-height: 1;
    opacity: 0.7;
    transition: opacity 0.2s;
  }

  .success-alert__close:hover {
    opacity: 1;
  }

  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.3s, transform 0.3s;
  }

  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
    transform: translateY(-20px);
  }
  </style>