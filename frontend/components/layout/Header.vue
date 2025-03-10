<template>
  <header
    :class="[
      'py-6 fixed top-0 w-full z-50 shadow-lg transition-all duration-500',
      'backdrop-blur-lg bg-opacity-80',
      backgroundClass,
    ]"
  >
    <div class="container mx-auto text-center px-6">
      <h1
        class="text-5xl font-bold text-white tracking-widest uppercase font-tech"
      >
        PRÓGNOSTICO CLIMÁTICO
      </h1>
    </div>
  </header>
</template>

<script setup lang="ts">
import { ref, watchEffect } from "vue";
import { useWeather } from "@/composables/useWeather";
import { useBackgroundClass } from "@/composables/useBackgroundClass";

const { weatherData } = useWeather();
const weather = ref<string | null>(weatherData.value?.data?.weather || "default");
const backgroundClass = useBackgroundClass(weather);

watchEffect(() => {
  weather.value = weatherData.value?.data?.weather || "default";
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap');

.font-tech {
  font-family: 'Orbitron', sans-serif;
}
</style>
