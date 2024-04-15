<?php

namespace App\Tests\Web\App\Controller;

use App\Factory\BlogFactory;
use App\Factory\UserFactory;
use App\Tests\Helpers\WebTestCaseUnit;

class DefaultControllerTest extends WebTestCaseUnit
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $user = UserFactory::createOne();
        BlogFactory::createMany(10, ['user' => $user]);

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello, world');
        $this->assertCount(6, $crawler->filter('div.row > div'));
    }
}
