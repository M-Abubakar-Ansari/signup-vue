<template>
  <div class="bg-white shadow-lg rounded-xl p-6 lg:w-[50vw] md:w-[80vw] h-fit">
    <div class="text-2xl w-full text-center font-bold border-b pb-2 mb-4">
      <slot name="header"></slot>
    </div>

    <div>
      <slot name="content"></slot>
    </div>

    <div v-if="$slots.footer" class="text-sm text-gray-500 text-center mt-4">
      <slot name="footer"></slot>
    </div>
  </div>
</template>


<script setup>
</script>
