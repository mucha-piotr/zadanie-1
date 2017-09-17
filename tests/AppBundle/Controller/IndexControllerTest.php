<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 17.09.2017
 * Time: 10:40
 */

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Zatwierdź formularz', $crawler->text());
    }
}