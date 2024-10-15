<?php

// src/Admin/EquipmentAdmin.php
namespace App\Admin;

use App\Entity\Equipment;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EquipmentAdmin extends AbstractAdmin
{
    // Configuration du formulaire d'édition/création
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name')
             ->add('category')
             ->add('price')
             ->add('lastMovement');
    }

    // Configuration des filtres pour la recherche
    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name')
                 ->add('category');
    }

    // Configuration de l'affichage dans la liste
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')
             ->add('name')
             ->add('category')
             ->add('price')
             ->add('lastMovement');
    }
}
