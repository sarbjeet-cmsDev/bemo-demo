<template>
  <button @click="toggleTheme" class="theme-toggle">
    {{ isDark ? '🌙 Dark' : '☀️ Light' }}
  </button>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const isDark = ref(false)

const setTheme = (dark) => {
  document.documentElement.setAttribute('data-theme', dark ? 'dark' : 'light')
  isDark.value = dark
  localStorage.setItem('theme', dark ? 'dark' : 'light')
}

const toggleTheme = () => {
  setTheme(!isDark.value)
}

onMounted(() => {
  const savedTheme = localStorage.getItem('theme')
  if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    setTheme(true)
  } else {
    setTheme(false)
  }
})
</script>

<style scoped>
.theme-toggle {
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  background-color: var(--color-primary);
  color: var(--color-white);
  transition: background-color 0.3s ease;
}
.theme-toggle:hover {
  background-color: var(--color-primary-hover);
}
</style>
