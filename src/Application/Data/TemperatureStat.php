<?php

namespace App\Application\Data;

class TemperatureStat
{
    private $min;
    private $max;
    private $avg;

    /**
     * TemperatureStat constructor.
     * @param $min
     * @param $max
     * @param $avg
     */
    public function __construct(float $min, float $max, float $avg)
    {
        $this->min = $min;
        $this->max = $max;
        $this->avg = $avg;
    }

    /**
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * @return float
     */
    public function getAvg(): float
    {
        return $this->avg;
    }
}
