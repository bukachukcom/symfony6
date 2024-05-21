<?php

namespace App\Controller\Api;

use App\Dto\BlogDto;
use App\Entity\Blog;
use App\Filter\BlogFilter;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class BlogController extends AbstractController
{
    #[Route('/api/blog', name: 'api_blog', methods: ['GET'], format: 'json')]
    public function index(BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->getBlogs();

        return $this->json($blogs, context: [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['category', 'createdAt'],
            AbstractNormalizer::GROUPS => ['select_box']
        ]);
    }

    #[Route('/api/blog', name: 'api_blog_add', methods: ['POST'], format: 'json')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $blog = new Blog($this->getUser());
        $form = $this->createForm(BlogType::class, $blog);
        $form->submit($request->toArray());

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blog);
            $em->flush();

            return $this->json($blog);
        } else {
            return $this->json((string) $form->getErrors(true, false));
        }
    }

    #[Route('/api/blog/dto', name: 'api_blog_add_dto', methods: ['POST'], format: 'json')]
    public function addDto(#[MapRequestPayload(acceptFormat: 'json')] BlogDto $blogDto, EntityManagerInterface $em): Response
    {
        $blog = Blog::createFromDto($this->getUser(), $blogDto);

        $em->persist($blog);
        $em->flush();

        return $this->json($blog);
    }

    #[Route('/api/blog/by_blog', name: 'api_blog_add_by_blog', methods: ['POST'], format: 'json')]
    public function addByBlog(#[MapRequestPayload(acceptFormat: 'json')] Blog $blog, EntityManagerInterface $em): Response
    {
        // Этот метод контроллера не работает тк blog требует User
        dd($blog);
        $em->persist($blog);
        $em->flush();

        return $this->json($blog);
    }

    #[Route('/api/blog/id/{blog}', name: 'api_blog_update', methods: ['PUT'], format: 'json')]
    public function update(Request $request, Blog $blog, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->submit($request->toArray());

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blog);
            $em->flush();

            return $this->json($blog);
        } else {
            return $this->json((string) $form->getErrors(true, false));
        }
    }

    #[Route('/api/blog/filter', name: 'api_blog_filter', methods: ['GET'], format: 'json')]
    public function filter(#[MapQueryString] BlogFilter $blogFilter, BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->findByBlogFilter($blogFilter);

        return $this->json($blogs->getQuery()->getResult());
    }

    #[Route('/api/blog/id/{blog}', name: 'api_blog_delete', methods: ['DELETE'], format: 'json')]
    public function delete(Blog $blog, EntityManagerInterface $em): Response
    {
        $em->remove($blog);
        $em->flush();

        return $this->json([]);
    }
}
