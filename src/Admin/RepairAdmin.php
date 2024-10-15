<?php

// src/Admin/RepairAdmin.php
namespace App\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class RepairAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('ReportDate', TextType::class, [
                'required' => true,
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('reportDate');
        $datagrid->add('startDate');
        $datagrid->add('endDate');
        $datagrid->add('description');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('reportDate');
        $list->addIdentifier('startDate');
        $list->addIdentifier('endDate');
        $list->addIdentifier('description');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('reportDate');
        $show->add('startDate');
        $show->add('endDate');
        $show->add('description');
    }
}