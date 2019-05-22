<?php


namespace App\Domain\ValueObject;

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
        if (empty ($latitude) || abs(floatval($latitude)) > 90) {
            throw new \InvalidArgumentException('Latitude should be between -90 and 90');
        }
        $this->latitude = $latitude;

        if (empty($longitude) || abs(floatval($longitude)) > 180) {
            throw new \InvalidArgumentException('Longitude should be between -180 and 180');
        }
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

    public function equals(Coordinates $coordinates)
    {
        return ((string) $this) === ((string) $coordinates);
    }
}

