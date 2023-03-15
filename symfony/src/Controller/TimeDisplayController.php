<?php

namespace App\Controller;

use PDO;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimeDisplayController extends AbstractController
{
    #[Route(path:'/timeDisplay', name: 'app_time_display')]
    public function timeDisplay()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
            
            
            
            $statement = $pdo->prepare('SELECT date FROM reservations');
            $statement->execute();
            $searchDate = $statement->fetchAll();
            

            $date1 = $_POST['date'];

            if($date1 === $searchDate[0]["date"]) {          
                echo 'c\'est la même date !';
            } else {
                
                echo 'c\'est pas la même date !';
                echo $date1 . '<br>';
                echo $searchDate[0]['date'];
            }
                



        } catch (PDOException $e) {
            echo 'Impossible de récupérer les données';
        }


        return $this->render('time_display/timeDisplay.html.twig');
    }
}
