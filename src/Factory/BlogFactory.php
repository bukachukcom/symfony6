<?php

namespace App\Factory;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Blog>
 *
 * @method        Blog|Proxy                     create(array|callable $attributes = [])
 * @method static Blog|Proxy                     createOne(array $attributes = [])
 * @method static Blog|Proxy                     find(object|array|mixed $criteria)
 * @method static Blog|Proxy                     findOrCreate(array $attributes)
 * @method static Blog|Proxy                     first(string $sortedField = 'id')
 * @method static Blog|Proxy                     last(string $sortedField = 'id')
 * @method static Blog|Proxy                     random(array $attributes = [])
 * @method static Blog|Proxy                     randomOrCreate(array $attributes = [])
 * @method static BlogRepository|RepositoryProxy repository()
 * @method static Blog[]|Proxy[]                 all()
 * @method static Blog[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Blog[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Blog[]|Proxy[]                 findBy(array $attributes)
 * @method static Blog[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Blog[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class BlogFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'blockedAt' => self::faker()->dateTime(),
            'createdAt' => self::faker()->dateTime(),
            'description' => self::faker()->text(),
            'status' => self::faker()->text(),
            'text' => self::faker()->text(),
            'title' => self::faker()->text(255),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Blog $blog): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Blog::class;
    }
}
