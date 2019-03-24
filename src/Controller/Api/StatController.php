<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 22.03.19
 * Time: 00:07
 */

namespace App\Controller\Api;

use App\Entity\City;
use App\Entity\WeatherData;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatController extends AbstractFOSRestController
{
    /**
     * @Route("/api/stat", name="weather_data_stat",  methods={"GET"})
     */

    public function statAction ()
    {
        $weatherRepository = $this->getDoctrine()->getRepository(WeatherData::class);
        $cityRepository = $this->getDoctrine()->getRepository(City::class);

        $response = [
            'temperature' => $weatherRepository->getTemperatureStat (),
            'mostPopularCity' => $cityRepository->findMostPopularCity(),
            'dataCount' => $weatherRepository->count([])
        ];

        $view = $this->view ($response, JsonResponse::HTTP_OK);
        return $this->handleView($view);
    }
}