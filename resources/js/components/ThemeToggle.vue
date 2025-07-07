<template>
  <button @click="toggleTheme" class="theme-toggle">
    {{ isDark ? '🌙 Dark' : '☀️ Light' }}
  </button>
</template>
<script>
export default {
  props: {
  },
  data() {
    return {
      isDark: false,
    }
  },
  methods: {
    toggleTheme() {
      this.isDark = !this.isDark;
      this.setTheme(this.isDark);
    },
    setTheme(isdark) {
      document.documentElement.setAttribute('data-theme', isdark ? 'dark' : 'light')
      this.isDark = isdark
      localStorage.setItem('theme', isdark ? 'dark' : 'light')
    }
  },
  mounted() {
    const savedTheme = localStorage.getItem('theme')
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      this.setTheme(true)
    } else {
      this.setTheme(false)
    }
  }
};5
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
