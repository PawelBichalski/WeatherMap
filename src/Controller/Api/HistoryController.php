<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 22.03.19
 * Time: 00:01
 */

namespace App\Controller\Api;

use App\Entity\WeatherData;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pagerfanta\Pagerfanta;



class HistoryController extends AbstractFOSRestController
{
    private $pageSize;

    public function __construct ($historyPageSize)
    {
        $this->pageSize = $historyPageSize;
    }
    /**
     * @Route("/api/history/{page}", defaults={"page"=1}, name="weather_data_history",  methods={"GET"})
     */

    public function historyAction ($page)
    {
        $pagerFanta = $this->getDoctrine()
            ->getRepository(WeatherData::class)
            ->findLatest ($page, $this->pageSize);

        $response = [
            'total' => $pagerFanta->getNbResults(),
            'numPages' => $pagerFanta->getNbPages (),
            'data' => $pagerFanta->getCurrentPageResults()
        ];

        $view = $this->view ($response, JsonResponse::HTTP_OK);
        return $this->handleView($view);
    }

}