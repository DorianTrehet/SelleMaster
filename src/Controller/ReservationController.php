<?php

// src/Controller/ReservationController.php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Equipment;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}/new', name: 'reservation_new')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(Equipment $equipment, Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new Reservation();
        $reservation->setEquipment($equipment);
        $reservation->setUser($this->getUser());

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        $errors = []; // Déclarez un tableau pour stocker les erreurs

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->persist($reservation);
                $em->flush();

                return $this->redirectToRoute('user_reservations', ['id' => $equipment->getId()]);
            } else {
                // Récupération des erreurs de validation
                foreach ($form->getErrors(true) as $error) {
                    $errors[] = $error->getMessage();
                }
            }
        }

        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView(),
            'equipment' => $equipment,
            'errors' => $errors, // Passer les erreurs à la vue
        ]);
    }

    #[Route('/reservations', name: 'user_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser(); 

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $reservations = $entityManager->getRepository(Reservation::class)->findBy(['user' => $user]);

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reservation/edit/{id}', name: 'reservation_edit')]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        // Créer le formulaire
        $form = $this->createForm(ReservationType::class, $reservation);
        
        // Traitement de la requête
        $form->handleRequest($request);
        $errors = []; // Déclarez un tableau pour stocker les erreurs

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $entityManager->flush(); // Enregistrer les modifications en base de données
                
                // Rediriger après la modification
                return $this->redirectToRoute('user_reservations');
            } else {
                // Récupération des erreurs de validation
                foreach ($form->getErrors(true) as $error) {
                    $errors[] = $error->getMessage();
                }
            }
        }

        // Passer la réservation au template
        return $this->render('reservation/edit.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
            'errors' => $errors, // Passer les erreurs à la vue
        ]);
    }

    #[Route('/reservation/cancel/{id}', name: 'reservation_cancel')]
    public function cancel(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        // Assurez-vous que l'utilisateur peut uniquement annuler ses propres réservations.
        $entityManager->remove($reservation);
        $entityManager->flush();

        // Redirigez vers la liste des réservations avec un message de succès
        return $this->redirectToRoute('user_reservations');
    }
}
