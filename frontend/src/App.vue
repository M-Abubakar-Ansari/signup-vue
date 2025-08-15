<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'

const isLoggedIn = ref(localStorage.getItem('auth'))
const route = useRoute()

// Hide header/footer when on /signup
const showLayout = computed(() => route.path !== '/signup')
</script>

<template>
  <div>
    <header 
      v-if="showLayout" 
      class="bg-white shadow-md"
    >
      <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <router-link to="/" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
          MyApp
        </router-link>

        <!-- Navigation Links -->
        <nav class="flex gap-6">
          <router-link
            to="/"
            class="text-gray-700 hover:text-blue-600 transition-colors"
            active-class="font-semibold text-blue-600"
          >
            Home
          </router-link>
          <router-link
            to="/signup"
            class="text-gray-700 hover:text-blue-600 transition-colors"
            active-class="font-semibold text-blue-600"
            v-if="!isLoggedIn"
          >
            Signup
          </router-link>
          <router-link
            v-if="isLoggedIn"
            to="/dashboard"
            class="text-gray-700 hover:text-blue-600 transition-colors"
            active-class="font-semibold text-blue-600"
          >
            Dashboard
          </router-link>
        </nav>
      </div>
    </header>

    <router-view></router-view>

    <footer 
      v-if="showLayout" 
      class="bg-white shadow-md"
    >
      <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <router-link to="/" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
          MyApp
        </router-link>
        <nav class="flex gap-6">
          <router-link
            to="/"
            class="text-gray-700 hover:text-blue-600 transition-colors"
            active-class="font-semibold text-blue-600"
          >
            Home
          </router-link>
          <router-link
            to="/signup"
            class="text-gray-700 hover:text-blue-600 transition-colors"
            active-class="font-semibold text-blue-600"
            v-if="!isLoggedIn"
          >
            Signup
          </router-link>
          <router-link
            v-if="isLoggedIn"
            to="/dashboard"
            class="text-gray-700 hover:text-blue-600 transition-colors"
            active-class="font-semibold text-blue-600"
          >
            Dashboard
          </router-link>
        </nav>
      </div>
    </footer>
  </div>
</template>
