<template>
  <footer :class="['text-white py-4 text-center w-full fixed bottom-0 shadow-lg', backgroundClass]">
    <p class="text-lg">Desenvolvido por <strong>Victor Gurgel</strong></p>
    <a href="https://github.com/vitugit" target="_blank" class="text-blue-400 hover:underline">
      Visite meu GitHub
    </a>
  </footer>
</template>

<script setup lang="ts">
import { ref, watchEffect } from "vue";
import { useWeather } from "@/composables/useWeather";
import { useBackgroundClass } from "@/composables/useBackgroundClass";

const { weatherData } = useWeather();
const weather = ref<string | null>(weatherData.value);
const backgroundClass = useBackgroundClass(weather);

watchEffect(() => {
weather.value = weatherData.value;
});
</script>
