<?php
namespace App\Resolver;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class BlogResolver implements ValueResolverInterface, EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [];
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        return [];
    }
}
