<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailsEquipmentController extends AbstractController
{
    #[Route('/equipment/{id}', name: 'app_details_equipment')]
    public function index(Equipment $equipment, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['equipment' => $equipment]);

        return $this->render('details_equipment/index.html.twig', [
            'equipment' => $equipment,
            'reservations' => $reservations,
        ]);
    }
}