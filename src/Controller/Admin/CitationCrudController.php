<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Citation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * Class CitationCrudController
 *
 *
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class CitationCrudController extends AbstractCrudController
{
    /**
     * This method returns the fully qualified class name of the entity managed by this CRUD controller.
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Citation::class;
    }

    /**
     * This method configures the labels used to refer to this entity in titles, buttons, etc.
     *
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Citation')
            ->setEntityLabelInSingular('Citation')

            ->setPageTitle('index','Devsquotes-Backend - Administration des citations')
            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    /**
     * This method configures which fields are displayed when listing
     *
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('french'),
            TextField::new('english'),
            AssociationField::new('author'),
            DateTimeField::new('createdAt')
                ->hideOnForm()
                ->setFormTypeOption('disabled', 'disabled'),

        ];
    }
}
