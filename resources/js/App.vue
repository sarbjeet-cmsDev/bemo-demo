<template>

  <div>
    <nav class="nav container">
      <router-link to="/" class="nav__brand">Bemo</router-link>
      <div class="nav__menu">
        <div class="nav__item">
          <router-link to="/" class="nav__link" :class="{ 'nav__link--active': $route.path === '/' }">
            Home
          </router-link>
        </div>
        <div class="nav__item">
          <router-link to="/dashboard" class="nav__link" :class="{ 'nav__link--active': $route.path === '/dashboard' }">
            Dashboard
          </router-link>
        </div>
        <div class="nav__item">
          <router-link to="/tickets" class="nav__link" :class="{ 'nav__link--active': $route.path === '/tickets' }">
            Tickets
          </router-link>
                <ThemeToggle />
        </div>
      </div>
    </nav>
    <main class="container">
      <router-view />
    </main>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
/* Component-specific styles if needed */
nav.nav{
  margin-bottom: 20px;
}
</style>
<script setup>
import ThemeToggle from './components/ThemeToggle.vue'
</script>
