<?php

namespace App\Controller;

use App\Entity\InfoUser;
use App\Entity\User;
use App\Form\FinalFormType;
use Doctrine\Persistence\ManagerRegistry;
use PDO;
use PDOException;
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
        $infoUser = new InfoUser();

        //Donner rôle USER à toutes les nouvelles structures créées
        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(FinalFormType::class, ['user' => $user, 'infoUser' => $infoUser]);
        $form->handleRequest($request);

        $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");

        if ($form->isSubmitted() && $form->isValid()) {

            $infoUser->setIdUser($user);

            //hasher le mdp avant de l'insérer en bdd
            $password = $user->getPassword();
            $hash_password = $encoder->hashPassword($user, $password);
            $user->setPassword($hash_password);


            $em = $doctrine->getManager();
            $em->persist($user);
            $em->persist($infoUser);
            $em->flush();
        }





        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
