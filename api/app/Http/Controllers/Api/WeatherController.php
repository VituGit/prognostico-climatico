<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;


class WeatherController extends Controller
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(Request $request): JsonResponse
    {
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');
        $geoData = $this->weatherService->getGeolocation($city);

        if (isset($geoData['error'])) {
            return response()->json(['error' => $geoData['error']], 400);
        }

        $weatherData = $this->weatherService->getWeather($geoData['lat'], $geoData['lon']);

        if (isset($weatherData['error'])) {
            return response()->json(['error' => $weatherData['error']], 500);
        }

        $translatedWeather = $this->weatherService->translateWeather($weatherData['weather'][0]['main'] ?? '');

        $formattedWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'feels_like' => $weatherData['main']['feels_like'] ?? null,
            'humidity' => $weatherData['main']['humidity'] ?? null,
            'pressure' => $weatherData['main']['pressure'] ?? null,
            'weather' => $translatedWeather, // ✅ Agora está traduzido
            'wind_speed' => $weatherData['wind']['speed'] ?? null,
            'city' => $city,
            'country' => $weatherData['sys']['country'] ?? null,
        ];

        return response()->json([
            'city' => $city,
            'data' => $formattedWeather
        ]);
    }


    public function testgetWeather(Request $request): JsonResponse
    {
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');

        // Simulação de geolocalização
        $geoData = [
            'lat' => -5.7945,  // Latitude de Natal, RN
            'lon' => -35.2110  // Longitude de Natal, RN
        ];

        // Simulação dos dados do clima
        $weatherData = [
            'temperature' => 29.5,
            'feels_like' => 31.2,
            'humidity' => 70,
            'pressure' => 1012,
            'weather' => 'Ensolarado',
            'wind_speed' => 5.4,
            'city' => $city,
            'country' => 'BR',
        ];

        return response()->json([
            'city' => $city,
            'data' => $weatherData
        ]);
    }
}
