import { ref } from "vue";
import { useFetch } from "#app"; 
interface WeatherResponse {
  city: string;
  data: {
    temperature: number;
    humidity: number;
    weather: string;
    wind_speed: number;
    country: string;
  };
}

const weatherCache = new Map<string, WeatherResponse>();

export function useWeather() {
  const weatherData = ref<WeatherResponse | null>(null);
  const errorMessage = ref<string>("");
  const loading = ref<boolean>(false);

  const fetchWeather = async (city: string): Promise<void> => {
    if (!city) return;

    errorMessage.value = "";
    weatherData.value = null;
    loading.value = true;

    if (weatherCache.has(city.toLowerCase())) {
      weatherData.value = weatherCache.get(city.toLowerCase())!;
      loading.value = false;
      return;
    }

    try {
      if (!city.trim()) {
        errorMessage.value = "Insira um nome de cidade válido.";
        return;
      }
    
      loading.value = true;
      errorMessage.value = "";
    
      const { data, error } = await useFetch<WeatherResponse>(`http://127.0.0.1:8000/api/weather?city=${encodeURIComponent(city)}`);
    
      if (error.value) {
        if (error.value.statusCode === 404) {
          errorMessage.value = "Cidade não encontrada. Verifique o nome e tente novamente.";
        } else if (error.value.statusCode === 500) {
          errorMessage.value = "Erro no servidor. Tente novamente mais tarde.";
        } else {
          errorMessage.value = "Erro ao buscar os dados. Tente novamente.";
        }
      } else if (!data.value || !data.value.data) {
        errorMessage.value = "Nenhuma informação disponível para esta cidade.";
      } else {
        weatherData.value = data.value;
        weatherCache.set(city.toLowerCase(), data.value);
      }
    } catch (err) {
      errorMessage.value = "Erro ao conectar à API. Verifique sua conexão e tente novamente.";
    } finally {
      loading.value = false;
    }
  };

  return { weatherData, errorMessage, loading, fetchWeather };
}
