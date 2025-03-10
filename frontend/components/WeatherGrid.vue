<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <WeatherCard 
      class="animate-fade-in transition-transform duration-300 ease-in-out hover:scale-105"
      icon="lucide:thermometer" 
      iconColor="text-red-400" 
      label="Temperatura" 
      :value="weatherData.data?.temperature + '°C'" 
    />
    <WeatherCard 
      class="animate-fade-in transition-transform duration-300 ease-in-out hover:scale-105 delay-100"
      icon="lucide:wind" 
      iconColor="text-blue-400" 
      label="Vento" 
      :value="weatherData.data?.wind_speed + ' km/h'" 
    />
    <WeatherCard 
      class="animate-fade-in transition-transform duration-300 ease-in-out hover:scale-105 delay-200"
      icon="lucide:droplet" 
      iconColor="text-blue-300" 
      label="Umidade" 
      :value="weatherData.data?.humidity + '%'" 
    />
    <WeatherCard 
      class="animate-fade-in transition-transform duration-300 ease-in-out hover:scale-105 delay-300"
      icon="lucide:cloud" 
      iconColor="text-gray-400" 
      label="Clima" 
      :value="weatherData.data?.weather" 
    />
  </div>
</template>

<script setup>
import WeatherCard from "@/components/WeatherCard.vue";

defineProps({
  weatherData: Object
});
</script>
