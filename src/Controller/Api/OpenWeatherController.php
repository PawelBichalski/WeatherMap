<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 21.03.19
 * Time: 21:38
 */

namespace App\Controller\Api;


use App\ValueObject\Coordinates;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Service\OpenWeatherService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class OpenWeatherController extends AbstractFOSRestController
{
    /**
     * @Route("/api/openweather/{latitude}/{longitude}", name="get_open_weather",  methods={"GET"})
     */
    public function openWeatherAction ($latitude, $longitude, OpenWeatherService $openWeatherService)
    {
        try {
            $weatherData = $openWeatherService->fetchData(new Coordinates($latitude, $longitude));
        }
        catch (\Exception $e) {
            $view = $this->view (
                ['error' => $e->getMessage()],
                JsonResponse::HTTP_SERVICE_UNAVAILABLE
            );
            return $this->handleView($view);
        }

        $entityManager = $this->getDoctrine()->getManager ();
        $entityManager->persist ($weatherData);
        $entityManager->flush ();

        $view = $this->view ($weatherData, JsonResponse::HTTP_OK);
        return $this->handleView($view);
    }

}