<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();
        $hash_password = $encoder->hashPassword($user, 'admin');

        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'AccueilController',
            'password' => $hash_password,
        ]);
    }
}
