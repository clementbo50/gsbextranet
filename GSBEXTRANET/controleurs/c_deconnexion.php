<?php



if(!isset($_GET['action'])){
	$_GET['action'] = 'deconnexion';
}
$action = $_GET['action'];
switch($action){
	
	case 'deconnexion':{
            
            
            $logConnexion = $pdo->recupLastLog($_SESSION['id']);
            $pdo->ajouteLogDeconnexion($_SESSION['id'], $logConnexion['max(dateDebutLog)']);
            
            include("vues/v_connexion.php");
            
            
            break;
            
        }
}

