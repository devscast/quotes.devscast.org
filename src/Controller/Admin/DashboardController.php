<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Citation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Class DashboardController
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * This method is used to configure the "dashboard" displayed by default when accessing the back-end.
     *
     * @return Response
     */
    #[Route('/admin', name: 'admin.index')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * This method configures the "dashboard" displayed by default when accessing the back-end.
     *
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Devsquotes-Backend - Administration')
            ->renderContentMaximized();
    }

    /**
     * This method is used to configure the items displayed in the menu.
     *
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-user', Author::class);
        yield MenuItem::linkToCrud('Citations', 'fas fa-user', Citation::class);
    }
}
