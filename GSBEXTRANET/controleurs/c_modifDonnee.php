<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'modifDonnee';
}
$action = $_GET['action'];
switch($action){
	
	case 'modifDonnee':{
            
            $medecin = $pdo->donneinfosmedecin($_SESSION['id']);
            
            
            
		include("vues/v_modifDonnee.php");
		break;
            
            
	}
        
        case 'ValidationModification':{
            
            $pdo->updateInfos($_SESSION['id'], $_POST['prenom'], $_POST['nom']);

            if(isset($_POST['check'])){
                include("vues/v_changeMdp.php");
            }
            else{
                include("vues/v_sommaire.php");
            }    
            
            break;
        }
        case 'ModifMdp':{
            
            $lemdp1 = htmlspecialchars($_POST['mdp1']);
            $lemdp2 = htmlspecialchars($_POST['mdp2']);
            
            
            if($lemdp1===$lemdp2){
                if((strlen($_POST['mdp1'])<8))
                {
                    include("vues/v_errorMdp.php");
                }
                else{
                    $pdo->updateMdp($_SESSION['id'], $_POST['mdp1'], $_POST['mdp2']);
                    include("vues/v_sommaire.php");
                }
            }
            else{
                include("vues/v_errorMdp.php");
            }
            
            
            
            break;
        }
        case 'ErrorRetour':{
            include("vues/v_changeMdp.php");
            
            break;
        }
        
            
}



