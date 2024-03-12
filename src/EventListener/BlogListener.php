<?php
namespace App\EventListener;

use App\Entity\Blog;
use App\Message\ContentWatchJob;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsDoctrineListener(event: Events::postFlush, priority: 500, connection: 'default')]
#[AsDoctrineListener(event: Events::postPersist, priority: 500, connection: 'default')]
class BlogListener
{
    private array $entities = [];

    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function postFlush(PostFlushEventArgs $event): void
    {
        foreach ($this->entities as $entity) {
            $this->bus->dispatch(new ContentWatchJob($entity->getId()));
        }
    }

    public function postPersist(PostPersistEventArgs $event)
    {
        if ($event->getObject() instanceof Blog) {
            $this->entities[] = $event->getObject();
        }
    }
}
