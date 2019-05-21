<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Domain\ValueObject\Coordinates;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Application\Service\WeatherService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class OpenWeatherController extends AbstractFOSRestController
{
    /**
     * @Route("/openweather/{latitude}/{longitude}", name="get_open_weather",  methods={"GET"})
     */
    public function openWeatherAction(string $latitude, string $longitude, WeatherService $weatherService)
    {
        try {
            $weatherDTO = $weatherService->fetchFromOpenWeather(new Coordinates($latitude, $longitude));
        } catch (\Exception $e) {
            $view = $this->view(
                ['error' => $e->getMessage()],
                JsonResponse::HTTP_SERVICE_UNAVAILABLE
            );
            return $this->handleView($view);
        }
        $weatherDTO = $weatherService->addWeather($weatherDTO);

        $view = $this->view($weatherDTO, JsonResponse::HTTP_OK);
        return $this->handleView($view);
    }
}
