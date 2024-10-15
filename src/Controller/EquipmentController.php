<?php

namespace App\Controller;

use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EquipmentController extends AbstractController
{
    #[Route('/equipment', name: 'app_equipment')]
    public function index(EquipmentRepository $equipmentRepository): Response
    {

        $equipments = $equipmentRepository->findAll();

        return $this->render('equipment/index.html.twig', [
            'equipments' => $equipments,
        ]);
    }
}
