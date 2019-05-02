<?php


namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Coordinates
{
    /**
     * @ORM\Column(type="decimal", precision=12, scale=8)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=8)
     */
    private $longitude;

    public function __construct(string $latitude, string $longitude)
    {

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    public function __toString()
    {
       return $this->latitude.', '.$this->longitude;
    }

    public function equals (Coordinates $coordinates)
    {
        return ((string) $this) === ((string) $coordinates);
    }
}