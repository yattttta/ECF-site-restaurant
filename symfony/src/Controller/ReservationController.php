<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Form\ReservationsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{   
    #[Route('/reservation', name: 'app_reservation')]
    public function reservations(Request $request, ManagerRegistry $doctrine): Response
    {
        $reservations = new Reservations;

        $form = $this->createForm(ReservationsType::class, $reservations);
        $form->handleRequest($request);
        $modal = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reservations);
            $em->flush();
            $modal = true;
        }

        return $this->render('reservation/reserver.html.twig', [
            'controller_name' => 'ReservationController',
            'reservations' => $form,
            'modal' => $modal,
        ]);
    }
}
