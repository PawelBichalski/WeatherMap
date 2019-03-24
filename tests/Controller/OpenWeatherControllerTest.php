<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 21.03.19
 * Time: 23:54
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class OpenWeatherControllerTest extends WebTestCase
{

    public function testOpenWeatherAction()
    {
        $client = static::createClient();

        $lat = 50.32 + (rand(0, 410)/100);
        $lng = 15.41+ (rand(0, 760)/100);

        $client->request ('GET', '/api/openweather/'.$lat.'/'.$lng,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            null
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
