<?php


namespace App\Application\DTO;

/**
 * Class CityDTO
 * @package App\Application\DTO
 */
class CityDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * CityDTO constructor.
     * @param int $id
     * @param string $name
     */

    public function __construct(int $id, string $name = '')
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
