<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET', 'POST'])]
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        if ($this->getUser() !== null) {
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

     #[Route('logout', name:'security.logout', methods: ['GET', 'POST'])]
    public function logout()
    {
        // Nothing to do here..
    }
}
