
<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
session_start();



date_default_timezone_set('Europe/Paris');



$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_GET['uc'])){
     $_GET['uc'] = 'connexion';
}
else {
    if($_GET['uc']=="connexion" && !estConnecte()){
        $_GET['uc'] = 'connexion';
    }
        
}
if($pdo->donneMaintenance() == 0)
{

$uc = $_GET['uc'];
switch($uc){
    
        
        
    
	case 'connexion':{
               
		include("controleurs/c_connexion.php");break;
	}
        case 'creation':{
		include("controleurs/c_creation.php");break;
	}
        case 'modifDonnee':{
                include("controleurs/c_modifDonnee.php");break;
        }
        case 'Deconnexion':{
            include("controleurs/c_deconnexion.php");
            break;
        }
        case 'produits':{
            include("controleurs/c_produits.php");break;
        }
        case'supression':{
            include("controleurs/c_supression.php"); break;
        }
        case'Archiver':{
            include("controleurs/c_supression.php");
            break;
        }
        case'Visio':{
            include("controleurs/c_VisioConference.php");
            break;
        }
        
            
        
}
        
}
else{
    include("vues/v_maintenance.html");
}
        include 'vues/v_footer.php';
        include'vues/v_cookies.php';
  


?>








