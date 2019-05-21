<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 22.03.19
 * Time: 00:07
 */

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\Service\StatisticService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatController extends AbstractFOSRestController
{
    /**
     * @Route("/stat", name="weather_data_stat",  methods={"GET"})
     */

    public function statAction(StatisticService $statisticService)
    {
        $view = $this->view($statisticService->getStats(), JsonResponse::HTTP_OK);
        return $this->handleView($view);
    }
}
