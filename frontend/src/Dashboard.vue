<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-xl p-6 flex flex-col">
      <div class="mb-10">
        <h1 class="text-2xl font-bold text-indigo-600">MyApp</h1>
        <p class="text-gray-500 text-sm mt-1">Dashboard</p>
      </div>
      
      <nav class="space-y-2 flex-1">
        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-50 text-indigo-700">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 transition">
          <i class="fas fa-chart-bar"></i>
          <span>Analytics</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:bg-gray-100 transition">
          <i class="fas fa-cog"></i>
          <span>Settings</span>
        </a>
      </nav>
      
      <div class="pt-4 border-t border-gray-200">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
            <i class="fas fa-user text-indigo-600"></i>
          </div>
          <div>
            <p class="font-medium">{{ user || "User" }}</p>
            <p class="text-sm text-gray-500">{{ mail || "email@example.com" }}</p>
          </div>
        </div>
      </div>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
      <!-- Email Verification Alert -->
      <Transition name="slide-down">
        <div 
          v-show="!mail_ver" 
          class="mb-8 bg-gradient-to-r from-red-500 to-red-600 text-white p-4 rounded-xl shadow-lg flex items-center justify-between"
        >
          <div class="flex items-center space-x-3">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <div>
              <h3 class="font-semibold">Email Verification Required</h3>
              <p class="text-sm opacity-90">Please verify your email to access all features</p>
            </div>
          </div>
          <button 
            @click="router.push('/signup')"
            class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-50 transition"
          >
            Verify Now
          </button>
        </div>
      </Transition>
      
      <!-- Dashboard Content -->
      <div class="bg-white rounded-2xl shadow-xl p-8 max-w-3xl">
        <div class="mb-10">
          <h1 class="text-3xl font-bold text-gray-800 mb-2">Account Overview</h1>
          <p class="text-gray-600">Manage your account settings and preferences</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
          <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-xl border border-indigo-100">
            <div class="flex items-center space-x-3 mb-3">
              <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                <i class="fas fa-lock text-indigo-600"></i>
              </div>
              <h3 class="font-semibold text-gray-800">Authentication</h3>
            </div>
            <div class="flex items-center">
              <div :class="`w-3 h-3 rounded-full mr-2 ${auth ? 'bg-green-500' : 'bg-red-500'}`"></div>
              <span class="text-gray-700">Status: {{ auth ? 'Authenticated' : 'Not Authenticated' }}</span>
            </div>
          </div>
          
          <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-xl border border-indigo-100">
            <div class="flex items-center space-x-3 mb-3">
              <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                <i class="fas fa-envelope text-indigo-600"></i>
              </div>
              <h3 class="font-semibold text-gray-800">Email Verification</h3>
            </div>
            <div class="flex items-center">
              <div :class="`w-3 h-3 rounded-full mr-2 ${mail_ver ? 'bg-green-500' : 'bg-red-500'}`"></div>
              <span class="text-gray-700">Status: {{ mail_ver ? 'Verified' : 'Not Verified' }}</span>
            </div>
          </div>
        </div>
        
        <div class="border-t border-gray-200 pt-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4">Account Management</h2>
          <button 
            @click="showDelete = true"
            class="flex items-center space-x-2 bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-lg shadow-md transition-all transform hover:scale-105"
          >
            <i class="fas fa-trash-alt"></i>
            <span>Delete Account</span>
          </button>
        </div>
      </div>
    </main>
    
    <!-- Delete Confirmation Modal -->
    <Transition name="fade-scale">
      <div 
        v-if="showDelete" 
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4"
        @click.self="showDelete = false"
      >
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md transform transition-all">
          <div class="p-6">
            <div class="flex items-center space-x-3 mb-4">
              <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
              </div>
              <h2 class="text-xl font-bold text-gray-800">Delete Account</h2>
            </div>
            
            <p class="text-gray-600 mb-6">
              This action cannot be undone. This will permanently delete your account and remove all your data.
            </p>
            
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">Enter your password to confirm</label>
              <div class="relative">
                <input
                  type="password"
                  v-model="pswd"
                  placeholder="Password"
                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                />
                <i class="fas fa-lock absolute right-3 top-3.5 text-gray-400"></i>
              </div>
            </div>
            
            <div class="flex justify-end space-x-3">
              <button 
                @click="showDelete = false"
                class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition"
              >
                Cancel
              </button>
              <button 
                @click="deleteAccount"
                class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition flex items-center space-x-2"
              >
                <i class="fas fa-trash-alt"></i>
                <span>Delete Account</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import router from './router';

const auth = ref(false);
const mail_ver = ref(false);
const showDelete = ref(false);
const user = ref("");
const mail = ref("");
const pswd = ref('');
const API_BASE = "http://localhost:8080/api";

async function deleteAccount(){
  try {
    const response = await axios.delete(`${API_BASE}/delete`, {
      data: {
        username: user.value,
        email: mail.value,
        password: pswd.value
      }
    });
    if (response.status === 401) {
      alert(response.data.error || "Incorrect password");
    } 
    else if (response.status === 200) {
      localStorage.clear();
      router.push('/');
    }
  } catch (err) {
    if (err.response) {
      alert(`Error: ${err.response.data.error || err.response.statusText}`);
    } else {
      console.error(err);
    }
  }
}

onMounted(() => {
  auth.value = localStorage.getItem('auth')?.toString().toLowerCase() === 'true';
  mail_ver.value = localStorage.getItem('mail_verf')?.toString().toLowerCase() === 'true';
  user.value = localStorage.getItem('name')?.toString();
  mail.value = localStorage.getItem('mail')?.toString();
  if (!auth.value) {
    router.push('/signup');
  }
});
</script>

<style scoped>
/* Transitions */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease;
}
.slide-down-enter-from {
  transform: translateY(-20px);
  opacity: 0;
}
.slide-down-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}

.fade-scale-enter-active,
.fade-scale-leave-active {
  transition: all 0.3s ease;
}
.fade-scale-enter-from,
.fade-scale-leave-to {
  opacity: 0;
  transform: scale(0.95);
}
</style>