<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 21.03.19
 * Time: 21:49
 */

namespace App\Infrastructure\OpenWeather;

use App\Application\DTO\CityDTO;
use App\Application\DTO\WeatherDTO;
use App\Domain\ValueObject\Coordinates;

class OpenWeatherService
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function fetchData(Coordinates $coordinates) : ?WeatherDTO
    {
        $headers = ['Accept' => 'application/json'];
        $query = [
            'lat' => $coordinates->getLatitude(),
            'lon' => $coordinates->getLongitude(),
            'units' => 'metric',
            'APPID' => $this->apiKey
        ];

        \Unirest\Request::jsonOpts(true);
        $response = \Unirest\Request::get(
            'http://api.openweathermap.org/data/2.5/weather',
            $headers,
            $query
        );
        if ($response->code != 200) {
            throw new \Exception("Brak komunikacji z openweathermap ".
                $response->code.
                (isset($response->body['message']) ? ' ('.$response->body['message'].')' : ''));
        }

        return $this->convertToDTO($response->body);
    }

    private function convertToDTO($data): WeatherDTO
    {
        return new WeatherDTO(
            $data['coord']['lat'],
            $data['coord']['lon'],
            new CityDTO($data['id'], $data['name']),
            $data['main']['temp'],
            $data['clouds']['all'],
            $data['wind']['speed'],
            $data['weather'][0]['description']
        );
    }
}
