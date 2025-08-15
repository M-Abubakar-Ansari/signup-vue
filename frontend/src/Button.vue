<template>
  <button
    :type="type"
    :disabled="disabled || loading"
    :class="[
      'px-4 py-2 rounded-lg font-semibold focus:outline-none transition-colors duration-200',
      fullWidth ? 'w-full' : '',
      variantClasses,
      (disabled || loading) ? 'opacity-60 cursor-not-allowed' : ''
    ]"
    @click="handleClick"
  >
    <!-- Loader Spinner -->
    <svg
      v-if="loading"
      class="animate-spin h-5 w-5 mr-2 inline-block text-white"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
    >
      <circle
        class="opacity-25"
        cx="12"
        cy="12"
        r="10"
        stroke="currentColor"
        stroke-width="4"
      ></circle>
      <path
        class="opacity-75"
        fill="currentColor"
        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
      ></path>
    </svg>

    <!-- Button Text -->
    <slot></slot>
  </button>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  type: { type: String, default: "button" },
  variant: { type: String, default: "primary" }, // primary, secondary, danger
  fullWidth: { type: Boolean, default: false },
  disabled: { type: Boolean, default: false },
  loading: { type: Boolean, default: false }
});

const emit = defineEmits(["click"]);

const variantClasses = computed(() => {
  switch (props.variant) {
    case "secondary":
      return "bg-gray-500 text-white hover:bg-gray-600";
    case "danger":
      return "bg-red-500 text-white hover:bg-red-600";
    default:
      return "bg-blue-500 text-white hover:bg-blue-600"; // primary
  }
});

function handleClick(event) {
  if (!props.disabled && !props.loading) {
    emit("click", event);
  }
}
</script>
