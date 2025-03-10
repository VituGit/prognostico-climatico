<template>
  <Icon 
    v-if="weatherIcon" 
    :name="weatherIcon" 
    class="weather-icon animate-fade-in animate-pulse"
  />
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  weather: String
});

const weatherIcon = computed(() => {
  const weather = props.weather ? props.weather.toLowerCase() : "default";

  if (weather.includes("céu limpo") || weather.includes("clear")) {
    return "lucide:sun";
  } else if (weather.includes("nublado") || weather.includes("clouds")) {
    return "lucide:cloud";
  } else if (weather.includes("chuva") || weather.includes("rain")) {
    return "lucide:cloud-rain";
  } else if (weather.includes("neve") || weather.includes("snow")) {
    return "lucide:snowflake";
  } else if (weather.includes("tempestade") || weather.includes("thunderstorm")) {
    return "lucide:cloud-lightning";
  } else if (weather.includes("chuvisco") || weather.includes("drizzle")) {
    return "lucide:cloud-drizzle";
  } else if (weather.includes("névoa") || weather.includes("mist")) {
    return "lucide:cloud-fog";
  } else if (weather.includes("nevoeiro") || weather.includes("fog")) {
    return "lucide:cloud-fog";
  } else if (weather.includes("neblina") || weather.includes("haze")) {
    return "lucide:cloud-fog";
  } else if (weather.includes("poeira") || weather.includes("dust")) {
    return "lucide:wind";
  } else if (weather.includes("fumaça") || weather.includes("smoke")) {
    return "lucide:smoke";
  } else if (weather.includes("areia") || weather.includes("sand")) {
    return "lucide:wind";
  } else if (weather.includes("cinzas") || weather.includes("ash")) {
    return "lucide:cloud";
  } else if (weather.includes("rajada de vento") || weather.includes("squall")) {
    return "lucide:wind";
  } else if (weather.includes("tornado")) {
    return "lucide:tornado";
  } else {
    return "lucide:cloud-sun"; 
  }
});
</script>

<style>
.weather-icon {
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translateX(-50%);
  width: 150px;
  height: 150px;
  opacity: 0.2;
  pointer-events: none;
  z-index: 0;
  animation: float 3s infinite ease-in-out;
}

@keyframes float {
  0% { transform: translateX(-50%) translateY(0); }
  50% { transform: translateX(-50%) translateY(-10px); }
  100% { transform: translateX(-50%) translateY(0); }
}
</style>
