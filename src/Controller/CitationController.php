<?php

namespace App\Controller;

use App\Entity\Citation;
use App\Form\CitationType;
use App\Repository\CitationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitationController extends AbstractController
{
    /**
     *  This function display all citations
     *
     * @param CitationRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/citation', name: 'index.citation', methods: ['GET'])]
    public function index(CitationRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $citations = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/citation/index.html.twig', [
            'citations' => $citations
        ]);
    }

    /**
     * This function show a form which create an citations
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/citation/new', name: 'citation.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $citation = new Citation();
        $form = $this->createForm(CitationType::class, $citation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $citation = $form->getData();

            $manager->persist($citation);
            $manager->flush();

            $this->addFlash
            (
                'success',
                'Votre citation a été créé avec succès !'
            );

          return $this->redirectToRoute('index.citation');
        }

        return $this->render('pages/citation/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/citation/edit/{id}', name: 'citation.edit', methods: ['GET' ,'POST'])]
    public function edit(Citation $citation, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CitationType::class, $citation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $citation = $form->getData();

            $manager->persist($citation);
            $manager->flush();

            $this->addFlash
            (
                'success',
                'Votre citation a été modifié avec succès !'
            );

            return $this->redirectToRoute('index.citation');
        }

        return $this->render('pages/citation/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/citation/delete/{id}', name: 'citation.delete', methods: ['GET', 'POST'])]
    public function delete(EntityManagerInterface $manager, Citation $citation): Response
    {
        $manager->remove($citation );
        $manager->flush();

        $this->addFlash
        (
            'success',
            'Votre citation a été supprimer avec succès !'
        );

        return $this->redirectToRoute('index.citation');
    }
}
