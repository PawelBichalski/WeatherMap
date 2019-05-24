<?php

namespace App\Tests\Domain\ValueObject;

use App\Domain\ValueObject\Coordinates;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{

    /**
     * @dataProvider validCoordinates
     * @param string $text
     * @param string $replaced
     */
    public function testEquals(string $latitude, string $longitude)
    {
        $coordinate1 = new Coordinates($latitude, $longitude);
        $coordinate2 = new Coordinates($latitude, $longitude);

        $this->assertTrue($coordinate1->equals($coordinate2));
        $coordinate3 = new Coordinates(mt_rand(-90, 90), mt_rand(-180, 180));

        $this->assertFalse($coordinate1->equals($coordinate3));
    }

    /**
     * @dataProvider validCoordinates
     * @param string $text
     * @param string $replaced
     */
    public function testToString(string $latitude, string $longitude)
    {
        $coordinate = new Coordinates($latitude, $longitude);

        $this->assertEquals($latitude.', '.$longitude, (string)$coordinate);
    }

    /**
     * @dataProvider validCoordinates
     * @param string $text
     * @param string $replaced
     */
    public function testConstructValid(string $latitude, string $longitude)
    {
        $coordinate = new Coordinates($latitude, $longitude);
        $this->assertEquals($latitude, $coordinate->getLatitude());
        $this->assertEquals($longitude, $coordinate->getLongitude());
    }

    /**
     * @dataProvider invalidCoordinates
     * @param string $text
     * @param string $replaced
     * @expectedException \InvalidArgumentException
     */
    public function testConstructInvalid(string $latitude, string $longitude)
    {
        new Coordinates($latitude, $longitude);
    }

    public function validCoordinates()
    {
        return [
            ['53.12', '13.643'],
            ['0.0', '0.0'],
            ['-12.656', '-56.234'],
            ['-90.00', '-180.00'],
            ['90.00', '180.00']
        ];
    }

    public function invalidCoordinates()
    {
        return [
            ['', '13.643'],
            ['0.0', ''],
            ['-90.01', '-56.234'],
            ['-90.00', '-180.01'],
            ['90.01', '180.00']
        ];
    }
}
