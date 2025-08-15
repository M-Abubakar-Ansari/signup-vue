<script setup>
import { ref } from 'vue';

const features = [
  { icon: 'fas fa-bolt', title: 'Lightning Fast', desc: 'Boost productivity instantly' },
  { icon: 'fas fa-users', title: 'Team Collaboration', desc: 'Work together seamlessly' },
  { icon: 'fas fa-chart-line', title: 'Smart Analytics', desc: 'Track progress in real-time' }
];

const ctaText = ref('Start Free Trial');
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-100 flex items-center justify-center p-4">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl p-8 md:p-12">
      <!-- Hero Section -->
      <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
          FlowSync
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
          Transform your workflow with our all-in-one productivity platform
        </p>
        <router-link
        to="/signup">
        <button 
          @click="ctaText = 'Loading...'" 
          class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition transform hover:scale-105 shadow-lg"
        >
          {{ ctaText }}
        </button>
        </router-link>
      </div>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div v-for="(feature, index) in features" :key="index" 
             class="bg-purple-50 p-6 rounded-xl border border-purple-100 hover:shadow-md transition">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
            <i :class="`${feature.icon} text-purple-600 text-xl`"></i>
          </div>
          <h3 class="font-semibold text-lg mb-2">{{ feature.title }}</h3>
          <p class="text-gray-600">{{ feature.desc }}</p>
        </div>
      </div>

      <!-- Trust Indicators -->
      <div class="flex items-center justify-center space-x-6 text-sm text-gray-500">
        <div class="flex items-center">
          <i class="fas fa-shield-alt text-green-500 mr-2"></i>
          <span>Secure</span>
        </div>
        <div class="flex items-center">
          <i class="fas fa-clock text-blue-500 mr-2"></i>
          <span>14-day trial</span>
        </div>
        <div class="flex items-center">
          <i class="fas fa-star text-yellow-400 mr-2"></i>
          <span>4.9/5 rating</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Minimal styles for fast loading */
</style>