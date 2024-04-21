<?php

namespace Tests\Web\Controller;

use App\Factory\BlogFactory;
use App\Factory\UserFactory;
use Tests\Helpers\WebTestCaseUnit;

final class DefaultControllerTest extends WebTestCaseUnit
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
