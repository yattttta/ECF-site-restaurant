<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Entity\InfoUser;
use App\Repository\InfoUserRepository;
use App\Form\ReservationsType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PDO;

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

        $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reservations);
            $em->flush();
        }

        return $this->render('reservation/reserver.html.twig', [
            'reservations' => $form,
        ]);
    }
}
