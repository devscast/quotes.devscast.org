<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * This function display all authors
     *
     * @param AuthorRepository $authorRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route('/author', name: 'author.index', methods: ['GET', 'POST'])]
    public function index(AuthorRepository $authorRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $authors = $paginator->paginate(
            $authorRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/Author/index.html.twig', [
            'authors' => $authors
        ]);
    }

    /**
     * This function allow us to create a new author
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/author/new', name: 'author.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $author = $form->getData();
            $manager->persist($author);
            $manager->flush();

            $this->addFlash
            (
                'success',
                'L\'auteur a été créer avec succès !'
            );

            return $this->redirectToRoute('author.index');
        }

        return $this->render('pages/Author/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * This function allow us to edit a new author
     *
     * @param Author $author
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/author/edit/{id}', name: 'author.edit', methods: ['GET' ,'POST'])]
    public function edit(Author $author, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $author = $form->getData();

            $manager->persist($author);
            $manager->flush();

            $this->addFlash
            (
                'success',
                'L\'auteur a été modifié avec succès !'
            );

            return $this->redirectToRoute('index.citation');
        }

        return $this->render('pages/Author/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This function allow us to delete a author
     *
     * @param EntityManagerInterface $manager
     * @param Author $author
     * @return Response
     */
    #[Route('/author/delete/{id}', name: 'author.delete', methods: ['GET', 'POST'])]
    public function delete(EntityManagerInterface $manager, Author $author): Response
    {
        $manager->remove($author);
        $manager->flush();

        $this->addFlash
        (
            'success',
            'L\'auteur a été supprimer avec succès !'
        );

        return $this->redirectToRoute('index.citation');
    }
}
