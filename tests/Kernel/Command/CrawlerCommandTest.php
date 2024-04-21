<?php
namespace Tests\Kernel\Command;

use App\Service\NewsGrabber;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Tests\Helpers\KernelTestCaseUnit;

final class CrawlerCommandTest extends KernelTestCaseUnit
{
    public function testExecute(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);

        $newsGrabber = self::createMock(NewsGrabber::class);
        $newsGrabber->expects($this->once())->method('setLogger')->willReturn($newsGrabber);
        $newsGrabber
            ->expects($this->once())->method('importNews')
            ->with(null, null);

        static::getContainer()->set(NewsGrabber::class, $newsGrabber);

        $command = $application->find('blog:news:import');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();
    }

    public function testExecuteParameters(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $newsGrabber = self::createMock(NewsGrabber::class);
        $newsGrabber->expects($this->once())->method('setLogger')->willReturn($newsGrabber);
        $newsGrabber
            ->expects($this->once())->method('importNews')
            ->with(10, true);

        static::getContainer()->set(NewsGrabber::class, $newsGrabber);

        $command = $application->find('blog:news:import');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['count' => 10, '--dryRun' => true]);

        $commandTester->assertCommandIsSuccessful();
    }
}
