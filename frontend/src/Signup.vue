<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Card from "./Card.vue";
import InputField from "./Input.vue";
import Button from "./Button.vue";
import router from "./router";

const email = ref("");
const uname = ref("");
const pswd = ref("");
const code = ref("");
const backendCode = ref("");
const loading = ref(false);
const errorMsg = ref("");
const successMsg = ref("");

const showVerify = ref(false);

onMounted(() => {
  showVerify.value = localStorage.getItem("mail_verf") === "false";
  if (
    localStorage.getItem("mail_verf") === "false" &&
    localStorage.getItem("backend_code")
  ) {
    backendCode.value = localStorage.getItem("backend_code");
  }
});

const API_BASE = "http://localhost:8080/api";

async function handleSignup() {
  loading.value = true;
  errorMsg.value = "";
  successMsg.value = "";

  try {
    const response = await axios.post(`${API_BASE}/register`, {
      username: uname.value,
      email: email.value,
      password: pswd.value,
    });

    successMsg.value = response.data.text || "Account created!";
    backendCode.value = response.data.ver_code;
    localStorage.setItem("auth", true);
    localStorage.setItem("name", uname.value);
    localStorage.setItem("mail", email.value);
    localStorage.setItem("mail_verf", false);
    localStorage.setItem("backend_code", backendCode.value);

    showVerify.value = true;
  } catch (error) {
    if (error.response) {
      errorMsg.value = JSON.stringify(error.response.data.errors);
    } else {
      errorMsg.value = "Server not reachable.";
    }
  } finally {
    loading.value = false;
  }
}

function verifyCode() {
  errorMsg.value = "";
  successMsg.value = "";
  if (code.value == backendCode.value) {
    successMsg.value = "Email verified!";
    localStorage.setItem("mail_verf", true);
    localStorage.removeItem("backend_code"); // Clear code only after verification
    router.push("/dashboard");
  } else {
    errorMsg.value = "Invalid code!";
  }
}
</script>
<template>
  <div class="w-full flex py-10 justify-center bg-gray-100">
    <Card>
      <template #header>
        <p v-show="!showVerify">Signup</p>
        <p v-show="showVerify">Verify Your Email</p>
      </template>

      <template #content>
        <!-- Signup Form -->
        <div v-show="!showVerify">
          <InputField
            v-model="email"
            label="Email"
            placeholder="Enter your email"
            type="email"
          />
          <InputField
            v-model="uname"
            label="Username"
            placeholder="Enter your name"
            type="text"
          />
          <InputField
            v-model="pswd"
            label="Password"
            placeholder="Enter your password"
            type="password"
          />
          <Button
            variant="primary"
            class="w-full m-0 mt-2"
            :loading="loading"
            @click="handleSignup"
          >
            Create Account
          </Button>
        </div>

        <div v-show="showVerify">
          <InputField
            v-model="code"
            label="Verification Code"
            placeholder="Enter code from email"
            type="text"
          />
          <Button variant="secondary" class="w-full m-0 mt-2" @click="verifyCode">
            Verify Email
          </Button>
          <p class="text-xs text-gray-400 mt-2">Check your email for the code.</p>
        </div>

        <p v-if="successMsg" class="text-green-600 text-sm mt-2">{{ successMsg }}</p>
        <p v-if="errorMsg" class="text-red-600 text-sm mt-2">{{ errorMsg }}</p>
        <a href="/">Home</a>
      </template>
    </Card>
  </div>
</template>
