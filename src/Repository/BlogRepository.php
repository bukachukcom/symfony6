<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Filter\BlogFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blog>
 *
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    /**
     * @return array<Blog>
     */
    public function getBlogs(): array
    {
        return $this
            ->createQueryBuilder('b')
            ->setMaxResults(6)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getByTitle(string $title): ?Blog
    {
        return $this->findOneBy(['title' => $title]);
    }

    public function findByBlogFilter(BlogFilter $blogFilter): QueryBuilder
    {
        $blogs = $this->createQueryBuilder('b')
            ->leftJoin('b.user', 'u')
            ->where('1 = 1')
        ;

        if ($blogFilter->getUser()) {
            $blogs
                ->andWhere('b.user = :user')
                ->setParameter('user', $blogFilter->getUser())
            ;
        }

        if ($blogFilter->getTitle()) {
            $blogs
                ->andWhere('b.title LIKE :title')
                ->setParameter('title', '%' . $blogFilter->getTitle() . '%')
            ;
        }

        $blogs->orderBy('b.id', 'DESC');

        return $blogs;
    }
}
