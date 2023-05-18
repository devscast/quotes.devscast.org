<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 *
 *
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class SecurityController extends AbstractController
{

    /**
     * This method is used to login the user
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
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

    /**
     * This method can be blank - it will be intercepted by the logout key on your firewall
     *
     * @return void
     */
     #[Route('logout', name:'security.logout', methods: ['GET', 'POST'])]
    public function logout()
    {
        // Nothing to do here..
    }
}
