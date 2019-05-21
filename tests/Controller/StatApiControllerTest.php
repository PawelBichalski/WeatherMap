<?php
/**
 * Created by PhpStorm.
 * User: pebek
 * Date: 23.03.19
 * Time: 13:23
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatApiControllerTest extends WebTestCase
{

    public function testStatAction()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/stat',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            null
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
