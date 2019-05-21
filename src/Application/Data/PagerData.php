<?php


namespace App\Application\Data;

use JMS\Serializer\Annotation as JMS;

class PagerData
{
    private $total;

    private $numPages;

    private $data;

    /**
     * PagerData constructor.
     * @param $total
     * @param $numPages
     * @param $data
     */
    public function __construct(int $total, int $numPages, $data = [])
    {
        $this->total = $total;
        $this->numPages = $numPages;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getNumPages(): int
    {
        return $this->numPages;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
