<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostProgramControllerTest extends WebTestCase
{
    public function testShowPostProgramControllerRoute1()
    {
        $client = static::createClient();

        $client->request('GET', '/program');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowPostProgramControllerRoute2_1()
    {
        $client = static::createClient();

        $client->request('GET', '/program/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowPostProgramControllerRoute2_2()
    {
        $client = static::createClient();

        $client->request('GET', '/program/4');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}