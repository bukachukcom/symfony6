<?php
namespace App\MessageHandler;

use App\Message\ContentWatchJob;
use App\Repository\BlogRepository;
use App\Service\ContentWatchApi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ContentWatchHandler
{
    public function __construct(
        private readonly ContentWatchApi $contentWatchApi,
        private readonly EntityManagerInterface $em,
        private readonly BlogRepository $blogRepository,
    )
    {
    }

    public function __invoke(ContentWatchJob $contentWatchJob): void
    {
        $blogId = (int)$contentWatchJob->getContent();
        $blog = $this->blogRepository->find($blogId);

        $blog->setPercent(
            $this->contentWatchApi->checkText($blog->getText())
        );

        $this->em->flush();
    }
}
