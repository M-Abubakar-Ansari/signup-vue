<template>
  <div class="w-full">
    <!-- Label -->
    <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 mb-1">
      {{ label }}
    </label>

    <!-- Input -->
    <input
      :id="id"
      :type="type"
      :placeholder="placeholder"
      v-model="inputValue"
      :class="[
        'w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2',
        error ? 'border-red-500 focus:ring-red-300' : 'border-gray-300 focus:ring-blue-300'
      ]"
    />

    <!-- Error -->
    <p v-if="error" class="text-red-500 text-xs mt-1">{{ error }}</p>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  modelValue: String,
  label: String,
  placeholder: String,
  type: { type: String, default: "text" },
  error: String,
  id: String
});

const emit = defineEmits(["update:modelValue"]);

const inputValue = ref(props.modelValue);

watch(inputValue, (val) => {
  emit("update:modelValue", val);
});

watch(
  () => props.modelValue,
  (val) => {
    inputValue.value = val;
  }
);
</script>
