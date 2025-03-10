<template>
  <div class="bg-gray-700 p-6 rounded-lg shadow-md flex items-center gap-3">
    <Icon :name="icon" class="w-6 h-6" :class="iconColor" />
    <p><strong>{{ label }}:</strong> {{ value }}</p>
  </div>
</template>

<script setup>
defineProps({
  icon: String,
  iconColor: String,
  label: String,
  value: [String, Number]
});
</script>
