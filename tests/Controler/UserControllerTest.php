<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-07-16
 * Time: 14:09
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/lotek');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}