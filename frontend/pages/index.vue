<template>
  <Background :weather="weatherData?.data?.weather || 'default'" />
  <Header />

  <div class="flex flex-col h-screen text-white p-6 relative overflow-hidden">

    <div class="absolute top-40 md:top-48 left-1/2 transform -translate-x-1/2 flex justify-center w-full">
      <WeatherIcon :weather="weatherData?.data?.weather || 'default'"
        class="w-14 h-14 md:w-20 md:h-20 opacity-25 pointer-events-none" />
    </div>

    <div
      class="absolute top-[35%] md:top-[45%] left-1/2 transform -translate-x-1/2 w-11/12 md:w-full max-w-md px-4 z-10 mb-4">
      <SearchBar @search="fetchWeather" />
    </div>

    <transition name="fade" appear>
      <div v-if="weatherData"
        class="absolute bottom-24 md:bottom-28 left-1/2 transform -translate-x-1/2 w-full max-w-2xl px-4">
        <h2 class="text-lg md:text-2xl font-semibold text-center mb-4">
          {{ formatCityName(weatherData.data?.city) }}, {{ weatherData.data?.country }}
        </h2>
        <WeatherGrid :weatherData="weatherData" class="mt-4 w-full" />
      </div>
    </transition>

    <div v-if="loading"
      class="absolute bottom-28 md:bottom-32 text-gray-300 text-lg text-center w-full flex items-center justify-center gap-2">
      <Icon name="lucide:loader" class="w-6 h-6 animate-spin text-gray-300" />
      <span>Carregando...</span>
    </div>


    <p v-if="errorMessage" class="absolute bottom-28 md:bottom-32 text-red-500 text-lg text-center w-full">{{
      errorMessage }}</p>
  </div>

  <Footer />
</template>

<script setup>
import { useWeather } from "@/composables/useWeather";
import SearchBar from "@/components/SearchBar.vue";
import Background from "@/components/Background.vue";
import WeatherIcon from "@/components/WeatherIcon.vue";
import WeatherGrid from "@/components/WeatherGrid.vue";
import Header from "@/components/layout/Header.vue";
import Footer from "@/components/layout/Footer.vue";

const { weatherData, errorMessage, loading, fetchWeather } = useWeather();
const formatCityName = (city) => {
  if (!city) return "";
  return city.charAt(0).toUpperCase() + city.slice(1).toLowerCase();
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
