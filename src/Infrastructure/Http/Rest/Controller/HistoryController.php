<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 22.03.19
 * Time: 00:01
 */

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\Service\HistoryService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HistoryController extends AbstractFOSRestController
{
    private $pageSize;

    public function __construct($historyPageSize)
    {
        $this->pageSize = $historyPageSize;
    }
    /**
     * @Route("/history/{page}", defaults={"page"=1}, name="weather_data_history",  methods={"GET"})
     */

    public function historyAction(int $page, HistoryService $historyService)
    {
        $response = $historyService->getHistory($page, $this->pageSize);

        $view = $this->view($response, JsonResponse::HTTP_OK);
        return $this->handleView($view);
    }
}
