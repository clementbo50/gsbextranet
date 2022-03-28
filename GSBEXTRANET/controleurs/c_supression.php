<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'supression';
}
$action = $_GET['action'];
switch($action){
	
	case 'supression':{
         include("vues/v_SupressionCompte.php");
         break;
        }
        case'supressionCompte':{
            if(isset ($_POST['btnSupression'])){
                $idCompte = $_SESSION['id'];
              $leCompte = $pdo->deleteMedecin($_SESSION['id']);
               
                include("vues/v_connexion.php");
                break;
            }
           
        }
        case'Archiver':{
            if(isset ($_POST['btnArchiver'])){
                $idCompte1 = $_SESSION['id'];
                $lecompte2 = $pdo->addAnneeArchivage($_SESSION['id']);
                $lecompte3 = $pdo->addArchivageConnexion($_SESSION['id']);
                $lecompte4 = $pdo->addProduitConsulte($_SESSION['id']);
                $lecompte5 = $pdo->addVisioConsulte($_SESSION['id']);
                
              $leCompte0 = $pdo->deleteMedecin($_SESSION['id']);
               
                include("vues/v_connexion.php");
                break;
            }
        }
}

