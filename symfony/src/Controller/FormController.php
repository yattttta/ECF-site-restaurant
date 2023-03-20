<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function form(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();

        //Donner rôle USER à toutes les nouvelles structures créées
        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //hasher le mdp avant de l'insérer en bdd
            $password = $user->getPassword();
            $hash_password = $encoder->hashPassword($user, $password);
            $user->setPassword($hash_password);


            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('form/form.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView(),
        ]);
    }
}
