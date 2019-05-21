<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 23.03.19
 * Time: 13:16
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HistoryApiControllerTest extends WebTestCase
{

    public function testHistoryAction()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/history/1',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            null
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
