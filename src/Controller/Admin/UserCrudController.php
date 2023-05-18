<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


/**
 * Class UserCrudController
 *
 * @author tresor-ilunga <ilungat82@gmail.com>
 */
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /**
     * This method is used to define the default configuration used by the CRUD controller.
     *
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('User')
            ->setEntityLabelInSingular('User')

            ->setPageTitle('index','Devsquotes-Backend - Administration des utilisateurs')
            ->setPaginatorPageSize(2)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    /**
     * This method is used to define the fields displayed by the CRUD controller.
     *
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('fullName'),
            TextField::new('email')
                ->hideOnForm()
                ->setFormTypeOption('disabled', 'disabled'),
            ArrayField::new('roles')
                ->hideOnIndex(),
            DateTimeField::new('createdAt')
                ->hideOnForm()
                ->setFormTypeOption('disabled', 'disabled'),
        ];
    }

}
