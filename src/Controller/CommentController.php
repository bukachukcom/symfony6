<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/add/{blog}', name: 'blog_add_comment', methods: ['POST'])]
    public function addComment(Request $request, EntityManagerInterface $em, Blog $blog): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setBlog($blog);
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_view', ['id' => $blog->getId()], Response::HTTP_SEE_OTHER);
        }
    }
}
