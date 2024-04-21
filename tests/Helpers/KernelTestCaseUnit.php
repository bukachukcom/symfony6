<?php

namespace Tests\Helpers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class KernelTestCaseUnit  extends WebTestCase
{
    use ResetDatabase;
    use Factories;
}
