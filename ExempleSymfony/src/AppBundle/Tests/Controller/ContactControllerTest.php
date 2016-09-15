<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Manager\ContactManager;
use AppBundle\Repository\ContactRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testListAvecMysql()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contacts/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Liste des contacts', $crawler->filter('h1')->text());

        $this->assertCount(2, $crawler->filter('h1 + ul > li'));
    }

    public function testListAvecMock()
    {
        $client = static::createClient();

        $contacts = [
            (new Contact())->setId(1)->setPrenom('A')->setNom('B'),
            (new Contact())->setId(2)->setPrenom('C')->setNom('D'),
            (new Contact())->setId(3)->setPrenom('E')->setNom('F'),
        ];

        $mockRepo = $this->prophesize(ContactRepository::class);
        $mockRepo->findAll()->willReturn($contacts)->shouldBeCalledTimes(1);

        $mockRegistry = $this->prophesize(Registry::class);
        $mockRegistry->getConnectionNames()->shouldBeCalledTimes(1);
        $mockRegistry->getManagerNames()->shouldBeCalledTimes(1);
        $mockRegistry->getRepository('AppBundle:Contact')->willReturn($mockRepo->reveal())->shouldBeCalledTimes(1);

        $client->getContainer()->set('doctrine', $mockRegistry->reveal());

        $crawler = $client->request('GET', '/contacts/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Liste des contacts', $crawler->filter('h1')->text());

        $this->assertCount(3, $crawler->filter('h1 + ul > li'));
    }

    public function testListAvecMockEtServiceLayer()
    {
        $client = static::createClient();

        $contacts = [
            (new Contact())->setId(1)->setPrenom('A')->setNom('B'),
            (new Contact())->setId(2)->setPrenom('C')->setNom('D'),
            (new Contact())->setId(3)->setPrenom('E')->setNom('F'),
        ];

        $mockRepo = $this->prophesize(ContactManager::class);
        $mockRepo->findAll()->willReturn($contacts)->shouldBeCalledTimes(1);

        $client->getContainer()->set('app.manager.contact', $mockRepo->reveal());

        $crawler = $client->request('GET', '/contacts/list-avec-manager');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Liste des contacts', $crawler->filter('h1')->text());

        $this->assertCount(3, $crawler->filter('h1 + ul > li'));
    }

}
