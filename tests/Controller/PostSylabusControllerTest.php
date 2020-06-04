<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostSylabusControllerTest extends WebTestCase
{
    public function testShowPostSylabusControllerRoute1_1()
    {
        $client = static::createClient();

        $client->request('GET', '/sylabus/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowPostSylabusControllerRoute1_2()
    {
        $client = static::createClient();

        $client->request('GET', '/sylabus/120');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}