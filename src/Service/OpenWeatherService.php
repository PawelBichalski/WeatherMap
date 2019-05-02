<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 21.03.19
 * Time: 21:49
 */

namespace App\Service;

use App\ValueObject\Coordinates;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\City;
use App\Entity\WeatherData;

class OpenWeatherService
{
    private $entityManager;
    private $apiKey;

    public function __construct(EntityManagerInterface $entityManager, string $apiKey)
    {
        $this->entityManager = $entityManager;
        $this->apiKey = $apiKey;
    }

    public function fetchData (Coordinates $coordinates) : ?WeatherData
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
        if ($response->code != 200)
        {
            throw new \Exception("Brak komunikacji z openweathermap ".
                $response->code.
                (isset ($response->body['message']) ? ' ('.$response->body['message'].')' : '')
            );
        }

        return $this->convertToEntity($response->body);
    }

    private function convertToEntity ($data)
    {
        $city = $this->entityManager->getRepository (City::class)->find($data['id']);
        if (!$city)
        {
            $city = new City();
            $city->setId($data['id']);
            $city->setName($data['name']);
        }

        $weatherData = new WeatherData();
        $weatherData->setCoordinates(new Coordinates(
            $data['coord']['lat'],
            $data['coord']['lon']
        ));
        $weatherData->setCity($city);
        $weatherData->setTemperature($data['main']['temp']);
        $weatherData->setClouds($data['clouds']['all']);
        $weatherData->setWind($data['wind']['speed']);
        $weatherData->setDescription($data['weather'][0]['description']);

        return $weatherData;
    }
}