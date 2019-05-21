<?php


namespace App\Application\Service;

use App\Application\Data\PagerData;
use App\Application\DTO\WeatherAssembler;
use App\Domain\Model\Weather\WeatherRepositoryInterface;
use Pagerfanta\Pagerfanta;
use App\Domain\Model\Weather\WeatherData;

class HistoryService
{
    private $weatherRepository;
    private $weatherAssembler;

    public function __construct(
        WeatherRepositoryInterface $weatherRepository,
        WeatherAssembler $weatherAssembler
    ) {
        $this->weatherRepository = $weatherRepository;
        $this->weatherAssembler = $weatherAssembler;
    }

    public function getHistory(int $page, int $pageSize)
    {
        $pagerFanta = $this->weatherRepository->findLatest($page, $pageSize);

        return new PagerData(
            $pagerFanta->getNbResults(),
            $pagerFanta->getNbPages(),
            array_map(
                function (WeatherData $weatherData) {
                    return $this->weatherAssembler->writeDTO($weatherData);
                },
                iterator_to_array($pagerFanta->getCurrentPageResults())
            )
        );
    }
}
