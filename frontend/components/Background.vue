<template>
  <div :class="backgroundClass" class="absolute inset-0 -z-20 transition-all duration-500"></div>
</template>

<script setup>
import { ref, watchEffect, defineProps } from "vue";
import { useBackgroundClass } from "@/composables/useBackgroundClass";

const props = defineProps({
  weather: String
});

const weatherRef = ref(props.weather || "default");
const backgroundClass = useBackgroundClass(weatherRef);

watchEffect(() => {
  weatherRef.value = props.weather || "default";
});
</script>
