<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Exception;

class WeatherService
{
    private string $apiKey;
    private string $geocodeUrl = 'https://api.openweathermap.org/geo/1.0/direct';
    private string $weatherUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        if (empty($this->apiKey)) {
            throw new Exception("Erro: A chave da API da OpenWeatherMap não está definida no .env!");
        }
    }

    private array $translations = [
        'Clear' => 'Céu limpo',
        'Clouds' => 'Nublado',
        'Rain' => 'Chuva',
        'Snow' => 'Neve',
        'Thunderstorm' => 'Tempestade',
        'Drizzle' => 'Chuvisco',
        'Mist' => 'Névoa',
        'Fog' => 'Nevoeiro',
        'Haze' => 'Neblina',
        'Dust' => 'Poeira',
        'Smoke' => 'Fumaça',
        'Sand' => 'Areia',
        'Ash' => 'Cinzas',
        'Squall' => 'Rajada de vento',
        'Tornado' => 'Tornado',
    ];

    public function translateWeather(string $weather): string
    {
        return $this->translations[$weather] ?? $weather;
    }

    public function getGeolocation(string $city): array
    {
        try {
            $response = Http::withoutVerifying()->get($this->geocodeUrl, [
                'q' => $city,
                'limit' => 1,
                'appid' => $this->apiKey
            ]);

            if ($response->failed()) {
                throw new Exception("Erro ao consultar a API de geolocalização.");
            }

            $data = $response->json();
            if (empty($data)) {
                throw new Exception("Cidade não encontrada.");
            }

            return [
                'lat' => $data[0]['lat'] ?? null,
                'lon' => $data[0]['lon'] ?? null,
            ];
        } catch (RequestException $e) {
            return ['error' => 'Erro na comunicação com a API de geolocalização.'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getWeather(float $lat, float $lon): array
    {
        try {
            $response = Http::withoutVerifying()->get($this->weatherUrl, [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'exclude' => 'minutely,hourly,alerts'
            ]);

            if ($response->failed()) {
                return [
                    'status' => $response->status(),
                    'message' => $response->body(),
                ];
            }

            return $response->json();
        } catch (RequestException $e) {
            return ['error' => 'Erro na comunicação com a API de clima.'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
