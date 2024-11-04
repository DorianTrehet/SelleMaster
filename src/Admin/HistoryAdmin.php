<?php

// src/Admin/HistoryAdmin.php
namespace App\Admin;

use App\Entity\Equipment;
use App\Entity\Movement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class HistoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
        ->add('equipment', EntityType::class, [
            'class' => Equipment::class,
            'choice_label' => 'name',
        ])
        ->add('maintenanceDate', DateTimeType::class, [
            'widget' => 'single_text',
            'required' => true,
        ])
        ->add('MaintenanceType', EntityType::class, [
            'class' => Movement::class,
            'choice_label' => 'name',
        ])
        ->add('cost', NumberType::class, [
            'scale' => 2,
        ])
        ->add('description', TextareaType::class, [
            'required' => false,
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {

    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
        ->addIdentifier('equipment.name', 'text', [
            'label' => 'Equipment',
        ])
        ->add('maintenanceType.name', 'text', [
            'label' => 'MaintenanceType',
        ])
        ->add('maintenanceDate')
        ->add('cost');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
        ->add('id')
        ->add('equipment.name')
        ->add('maintenanceType.name')
        ->add('maintenanceDate')
        ->add('cost')
        ->add('description');
    }
}