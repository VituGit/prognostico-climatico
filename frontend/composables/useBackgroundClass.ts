import { computed, ref, watchEffect } from "vue";

export function useBackgroundClass(weather: ReturnType<typeof ref<string | null>>) {
  const backgroundClass = ref("bg-gray-900"); 

  watchEffect(() => {
    const w = weather.value ? weather.value.toLowerCase() : "default";

    if (w.includes("céu limpo") || w.includes("clear") || w.includes("sun")) {
      backgroundClass.value = "bg-gradient-to-r from-blue-500 to-yellow-400"; 
    } else if (w.includes("nublado") || w.includes("clouds")) {
      backgroundClass.value = "bg-gradient-to-r from-gray-600 to-gray-400"; 
    } else if (w.includes("chuva") || w.includes("rain")) {
      backgroundClass.value = "bg-gradient-to-r from-blue-900 to-blue-600"; 
    } else if (w.includes("neve") || w.includes("snow")) {
      backgroundClass.value = "bg-gradient-to-r from-gray-200 to-white"; 
    } else if (w.includes("tempestade") || w.includes("thunderstorm")) {
      backgroundClass.value = "bg-gradient-to-r from-gray-900 to-purple-700"; 
    } else if (w.includes("chuvisco") || w.includes("drizzle")) {
      backgroundClass.value = "bg-gradient-to-r from-blue-600 to-gray-400"; 
    } else if (w.includes("névoa") || w.includes("mist") || w.includes("nevoeiro") || w.includes("fog") || w.includes("haze")) {
      backgroundClass.value = "bg-gradient-to-r from-gray-500 to-gray-300"; 
    } else if (w.includes("poeira") || w.includes("dust") || w.includes("areia") || w.includes("sand")) {
      backgroundClass.value = "bg-gradient-to-r from-yellow-700 to-orange-500"; 
    } else if (w.includes("fumaça") || w.includes("smoke")) {
      backgroundClass.value = "bg-gradient-to-r from-gray-800 to-gray-600"; 
    } else if (w.includes("cinzas") || w.includes("ash")) {
      backgroundClass.value = "bg-gradient-to-r from-gray-700 to-gray-500"; 
    } else if (w.includes("rajada de vento") || w.includes("squall")) {
      backgroundClass.value = "bg-gradient-to-r from-teal-700 to-blue-400"; 
    } else if (w.includes("tornado")) {
      backgroundClass.value = "bg-gradient-to-r from-black to-gray-700"; 
    } else {
      backgroundClass.value = "bg-gray-900"; 
    }
  });

  return backgroundClass;
}
