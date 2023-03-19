<?php

namespace App\Controller;

use PDO;
use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TimeDisplayController extends AbstractController
{
    #[Route(path:'/timeDisplay', name: 'app_time_display')]
    public function timeDisplay()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
            
            //récupération de la date selectionnée
            $date1 = $_POST['date'];
                        
            //récupération des données dans table réservation
            $statement = $pdo->prepare('SELECT time, convives FROM reservations WHERE date like ?');
            $statement->setFetchMode(PDO::FETCH_ASSOC).
            $statement->execute(array(trim($date1)."%"));
            $searchDateTime = $statement->fetchAll();

            //date du jour format text
            $todayDate = date('y-m-d');

            //convertir les dates en timestamp unix
            $date1Ts = strtotime($date1);
            $todayDateTs = strtotime($todayDate);

            //récupérer le jour de la semaine de la date selectionnée
            $infosDay = getdate($date1Ts);
            $weekDay = $infosDay['weekday'];
                        
            //liste des horaires d'ouverture
            $horairesMidi = ["12h00", "12h15", "12h30", "12h45", "13h00"];
            $horairesSoir = ["19h00", "19h15", "19h30", "19h45", "20h00", "20h15", "20h30", "20h45", "21h00"];

            //Initialisation nombre de convives
            $nbConvivesMidi = 0;
            
            $nbConvivesSoir = 0;
            
            
            //calculer le nombre de convives le midi
            for ($x = 0; $x < count($searchDateTime); $x++) {
                if(in_array($searchDateTime[$x]["time"], $horairesMidi)) {
                    if($nbConvivesMidi < 21) {
                        $nbConvivesMidi = $nbConvivesMidi + $searchDateTime[$x]["convives"];
                    }
                }
            }
        
            //calculer le nombre de convives le soir
            for ($y = 0; $y < count($searchDateTime); $y++) {
                if(in_array($searchDateTime[$y]["time"], $horairesSoir)) {
                    if($nbConvivesSoir < 21) {
                        $nbConvivesSoir = $nbConvivesSoir + $searchDateTime[$y]["convives"];
                    }
                }
            }
            
            $nbPlacesMidiRestantes = 20 - $nbConvivesMidi;
            $nbPlacesSoirRestantes = 20 - $nbConvivesSoir;

            
            echo '<div class="row" id="midi">';
            //comparer les deux dates entre elles
            if ($date1Ts < $todayDateTs) {
                echo 'Ce jour est déjà passé !';

            //Bloquer les réservations si il y a déjà 20 convives le midi    
            } elseif ($nbConvivesMidi > 19) {
                echo 'Il n\' y a plus de place de libre au service du midi à cette date !';
            //condition si le jour selectionné est un dimanche ou un lundi (restaurant fermé)    
            } elseif ($weekDay === 'Sunday' || $weekDay === 'Monday') {
                echo 'Nous sommes fermés ce jour ! <br>';

            //afichage des horaires disponibles le midi    
            } else {
                echo 'il reste ' . $nbPlacesMidiRestantes . ' place(s) disponible pour le service du midi, veuillez ne pas en selectionner plus.<br>';
                for ($j = 0; $j < count($horairesMidi); $j++) {
                    echo '<div type="text" class="col heure ' . $horairesMidi[$j] . ' m-2" value="' . $horairesMidi[$j] . '" id="' . $horairesMidi[$j] . '">';
                    echo $horairesMidi[$j];
                    echo '</div>';                
                }
            }
            echo '</div>';
            
            echo '<div class="row" id="soir">';
            //comparer les deux dates entre elles
            if ($date1Ts < $todayDateTs) {
            //Bloquer les réservations si il y a déjà 20 convives le midi     
            } elseif ($nbConvivesSoir > 19 ) {
                echo 'Il n\'y a plus de place au service du soir à cette date !';    
            //condition si le jour selectionné est un dimanche ou un lundi (restaurant fermé)
            } elseif ($weekDay === 'Sunday' || $weekDay === 'Monday') {               
            //affichage des horaires disponibles du soir    
            } else {
                echo 'il reste ' . $nbPlacesSoirRestantes . ' place(s) disponible pour le service du soir, veuillez ne pas en selectionner plus.<br>';
                for ($l = 0; $l < count($horairesSoir); $l++) {
                    echo '<div type="text" class="col heure m-2 ' . $horairesSoir[$l] . '" value="' . $horairesSoir[$l] . '" id="' . $horairesSoir[$l] . '">'; 
                    echo $horairesSoir[$l];
                    echo '</div>';
                }
            }    
            echo '</div>';


            //Enlever les horaires du tableau du midi quand ils ont été réservés

            //for ($i = 0; $i < count($searchDateTime); $i++) {
            //    if (in_array($searchDateTime[$i]["time"], $horairesMidi)) {
            //        $keyFind = array_search($searchDateTime[$i]["time"], $horairesMidi);
            //        array_splice($horairesMidi,$keyFind,1);
            //    }
            //}

            //Enlever les horaires du tableau du soir quand ils ont été réservés

            //for ($k = 0; $k < count($searchDateTime); $k++) {
            //    if (in_array($searchDateTime[$k]["time"], $horairesSoir)) {
            //        $keyFind = array_search($searchDateTime[$k]["time"], $horairesSoir);
            //        array_splice($horairesSoir,$keyFind,1);
            //    }
            //}
            
        } catch (PDOException $e) {
            echo 'Impossible de récupérer les données';
        }

        return $this->render('time_display/timeDisplay.html.twig');
    }
}
