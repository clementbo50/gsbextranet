<?php

/** 
 * Classe d'accÃ¨s aux donnÃ©es. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbextranet3';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
	private static $monPdo;
	private static $monPdoGsb=null;
		
/**
 * Constructeur privÃ©, crÃ©e l'instance de PDO qui sera sollicitÃ©e
 * pour toutes les mÃ©thodes de la classe
 */				
	private function __construct(){
          
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crÃ©e l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * vÃ©rifie si le login et le mot de passe sont corrects
 * renvoie true si les 2 sont corrects
 * @param type $lePDO
 * @param type $login
 * @param type $pwd
 * @return bool
 * @throws Exception
 */
function checkUser($login,$pwd):bool {
    //AJOUTER TEST SUR TOKEN POUR ACTIVATION DU COMPTE
    $user=false;
    //Connexion à la bdd
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT motDePasse FROM medecin WHERE mail= :login AND token IS NULL");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    //Si la requete est executer on récupère l'utilisateur grace à la fonction fetch()
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        if (is_array($unUser)){
            //On verifie le mot de passe haché avec le mot de passe saisit par l'utilisateur
           if (password_verify($pwd, $unUser['motDePasse']))
                $user=true;
        }
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $user;   
}


	

function donneLeMedecinByMail($login) {
    //On obtient l'information d'un medecin à partir de son mail
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail, numGrade FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $unUser;   
}


public function tailleChampsMail(){
    

    
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS
WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
    $execution = $pdoStatement->execute();
$leResultat = $pdoStatement->fetch();
      
      return $leResultat[0];
    
       
       
}


public function creeMedecin($email, $mdp, $nom, $prenom)
{
    //Hachage du mot de passe passer en paramètre
    $mdpHashe = password_hash($mdp, PASSWORD_DEFAULT);
    //requete d'insertion à la table medecin
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id, nom, prenom ,mail, motDePasse,dateCreation,dateConsentement, numGrade) "
            . "VALUES(null, :leNom, :lePrenom, :leMail, :leMdpHashe, now(),now(), 2)");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $bv2 = $pdoStatement->bindValue(':leMdpHashe', $mdpHashe);
    $bv3 = $pdoStatement->bindValue(':leNom', $nom, PDO::PARAM_STR);
    $bv4 = $pdoStatement->bindValue(':lePrenom', $prenom, PDO::PARAM_STR);
   
    $execution = $pdoStatement->execute();
    return $execution;
    
}


function testMail($email){
    //On verifie si le mail est présent dans la base de donnée
    $pdo = PdoGsb::$monPdo;
    $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $execution = $pdoStatement->execute();
    $resultatRequete = $pdoStatement->fetch();
    if ($resultatRequete['nbMail']==0)
        $mailTrouve = false;
    else
        $mailTrouve=true;
    
    return $mailTrouve;
}




function connexionInitiale($mail){
    
     $pdo = PdoGsb::$monPdo;
    $medecin= $this->donneLeMedecinByMail($mail);
    $id = $medecin['id'];
    $this->ajouteConnexionInitiale($id);
    
}

function ajouteConnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), now())");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function donneinfosmedecin($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom, numGrade FROM medecin WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        return $unUser;
   
    }
    else
        throw new Exception("erreur");
           
    
}

function updateInfos($id, $prenom, $nom){
    
    $pdo = PdoGsb::$monPdo;
    
    $monObjPdoStatement=$pdo->prepare("update medecin set prenom = :prenom, nom = :nom WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2=$monObjPdoStatement->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $bvc3 = $monObjPdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $execute = $monObjPdoStatement->execute();
    return $execute;
       
}

function updateMdp($id, $mdp1){
    
    $pdo = PdoGsb::$monPdo;
        $mdpHash = password_hash($mdp1, PASSWORD_DEFAULT);
        $monObjPdoStatement=$pdo->prepare("update medecin set motDePasse= :mdpH WHERE id= :lId");
        $bvc1=$monObjPdoStatement->bindValue(':mdpH',$mdpHash,PDO::PARAM_STR);
        $bvc2=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
        $execute = $monObjPdoStatement->execute();
        return $execute;        
}

function ajouteLogConnexion($id){
    //Ajout dans la bdd la date à laquelle s'est connecter l'utilisateur tandis que la dateFinLog est en null en attendant sa deconnexion
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), null)");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}

function ajouteLogDeconnexion($id, $logConnexion){
    //Quand l'utilisateur clique sur le bouton deconnexion on vient mettre à jours le champs dateFinLog
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE historiqueconnexion "
            . "SET dateFinLog = now() WHERE idMedecin = :leMedecin AND dateDebutLog = :dateLog;");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $bv2 = $pdoStatement->bindValue(':dateLog', $logConnexion);
    $execution = $pdoStatement->execute();
    return $execution;
    
}

function recupLastLog($id){
    //On recupère la dernière connexion de l'utilisateur
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT max(dateDebutLog) "
             . "FROM historiqueConnexion WHERE idMedecin= :lId");
     $bv1 = $pdoStatement->bindValue(':lId', $id);
     
     if ($pdoStatement->execute()) {
        $monLog=$pdoStatement->fetch();
        return $monLog;
   
    }
    else
        throw new Exception("erreur");

}

function recupAllProduits(){
    //On recupère toute la liste des produits
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM produit;");
    if ($pdoStatement->execute()) {
        $lesNoms=$pdoStatement->fetchAll();
        return $lesNoms;
   
    }
    else
        throw new Exception("erreur");
}

function recupProduitById($id){
    //On recupère un produit par son id
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM produit WHERE id= :lId;");
    $bv1 = $pdoStatement->bindValue(':lId', $id);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");

}
function deleteProduit($idProduit){
    //On supprime un produit [Administrateur]
    $pdoStatement = PdoGsb::$monPdo->prepare("DELETE FROM produit WHERE id= :lId;");
    $bv1 = $pdoStatement->bindValue(':lId', $idProduit);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");
    
}

function updateProduit($id, $nom, $objectif, $info, $effet){
    
//On met à jour les valeurs d'un produit [Administrateur]
    
    $pdoStatement = PdoGsb::$monPdo->prepare("update produit set nom = :nom,"
            . " objectif = :objectif, information = :information, effetIndesirable"
            . " = :effet WHERE id= :id");
//    $bvc1 = $pdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':information', $info, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':effet', $effet, PDO::PARAM_STR);
    $bvc6 = $pdoStatement->bindValue(':id',$id,PDO::PARAM_INT);
    if ($pdoStatement->execute()) {
        $leProduit=$pdoStatement->fetch();
        return $leProduit;
    }
    else
        throw new Exception("erreur");
       
}

function createProduit($nom, $objectif, $info, $effet){
    
//On crée via un formulaire un produit [Administrateur]
    
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO produit VALUES (null,"
            . ":nom, :objectif, :information ,:effet)");
//    $bvc1 = $pdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':information', $info, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':effet', $effet, PDO::PARAM_STR);
    $executeOk = $pdoStatement->execute();
    return $executeOk;
       
}

function addHistoriqueConsultationProduit($idMedecin, $idProduit){
    //requete sql : INSERT INTO medecinproduit VALUES(23, 13, now(), time(now()));
    //time(now()) --> permet d'obtenir l'heure 
    $pdoStatement = PdoGsb::$monPdo->prepare('INSERT INTO medecinproduit VALUES(:idMedecin, :idProduit, now(), time(now()))');
    $bv1 = $pdoStatement->bindValue(':idMedecin', $idMedecin, PDO::PARAM_INT);
    $bv2 = $pdoStatement->bindValue(':idProduit', $idProduit, PDO::PARAM_INT);
    $executionIsok = $pdoStatement->execute();
    return $executionIsok;
}

function deleteMedecin($idCompte){
    //On supprime le compte medecin
    $pdoStatement = PdoGsb::$monPdo->prepare("DELETE FROM medecin WHERE id= :lId;");
    $bv1 = $pdoStatement->bindValue(':lId', $idCompte);
    if ($pdoStatement->execute()) {
        $leCompte=$pdoStatement->fetch();
        return $leCompte;
    }
    else
        throw new Exception("erreur");
    
}
function AddAnneeArchivage($id){
    //On recupère la date de naissance et la date de créarion du medecin pour l'archiver 
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT dateNaissance,dateCreation  FROM medecin WHERE id = :id;");
    
    $bv1 = $pdoStatement->bindValue(':id', $id);
    if ($pdoStatement->execute()) {
       $infoAnneeDateCreation = $pdoStatement->fetch();
       
       
        //return $infoAnneeDateCreation; 
       
       //On va inserer dans la table medecinArchivage, l'idArchivage, l'année de naissance du medecin, sa date de creation et enfin sa date d'archivage.
     
      $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archivagemedecin (idArchivage, AnneeNaissanceMedecin, DateCreationMedecin, DateArchivageMedecin)" . "VALUES(:id, :annee, :dateCreation, now());");
      //var_dump($infoAnneeDateCreation);
      
      $bv1 = $pdoStatement->bindValue(':id', $id);
      //On recupère la date de naissance de l'année de naissance du medecin et sa date de création
      $bvc2 = $pdoStatement->bindValue(':annee', $infoAnneeDateCreation['dateNaissance']);
   
      $bvc3 = $pdoStatement->bindValue(':dateCreation',$infoAnneeDateCreation['dateCreation']);
    
   
      $executeOk = $pdoStatement->execute();
      return $executeOk;
   }
   else{
       throw new Exception("Une erreur ! ");
   }
   
}   
function addArchivageConnexion($id){
    $i = 0;
    //On recuppère tout l'historique de connexion d'un medecin
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT dateDebutLog,dateFinLog  FROM historiqueconnexion WHERE idMedecin = :id;");
    
    $bv1 = $pdoStatement->bindValue(':id', $id);
    
    if ($pdoStatement->execute()) {
        
       $infoConnexion = $pdoStatement->fetchAll();
       
       //var_dump($infoConnexion);
       //return $infoConnexion;
       
       //On insère dans la table d'archivage connexion l'id
        $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archivageconnexion (idMedecinArchivage, HistoriqueConnexion, HistoriqueDeconnexion, DateArchivage)" . "VALUES(:id, :connexion, :deconnexion, now());");
        
        foreach($infoConnexion as $il){
            $bv1 = $pdoStatement->bindValue(':id', $id);
            $bvc1 = $pdoStatement->bindValue(':connexion',$infoConnexion[$i]['dateDebutLog']);
            
            $bvc2 = $pdoStatement->bindValue(':deconnexion',$infoConnexion[$i]['dateFinLog']);
            $i = $i +1;
             $executeOk = $pdoStatement->execute();
        }
        
        
        

        
        return $executeOk;
}

}
function addProduitConsulte($id){
    //On recupère l'id des produits consultés par le medecin 
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT idProduit FROM medecinproduit WHERE idMedecin = :id;");
    $bv1 = $pdoStatement->bindValue(':id', $id);
    if ($pdoStatement->execute()) {
       $infoproduit = $pdoStatement->fetchAll();
       //var_dump($infoproduit);
       //return $infoproduit;
       
       //On va inserer l'id du medecin, l'id du produit consulte, et la date d'archivage
       $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archivageproduit (idMedArchivage, idProduitConsulte, dateArchivage)"."VALUES(:id, :idProduit, now());");
       //On crée une boucle qui va permèttre d'ajouter l'un après l'autre les produits consultés
       foreach($infoproduit as $produit){
           $bv1 = $pdoStatement->bindValue(':id', $id);
           // $infoproduit[$i] on fait un compteur pour pouvoir y ajouter l'id du produit consultés à x position
           $bvc1 = $pdoStatement->bindValue(':idProduit', $infoproduit[$i]['idProduit']);
           $i = $i +1;
           $execution = $pdoStatement->execute();
       }
       return $execution;
       
    }
}
function addVisioConsulte($id){
    //On recupère l'ensemble des id visio consultés par le medecin 
    $i = 0;
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT idVisio FROM medecinvisio WHERE idMedecin = :id;");
    $bv1 = $pdoStatement->bindValue(':id', $id);
     if ($pdoStatement->execute()) {
       $infoVisio = $pdoStatement->fetchAll();
       //var_dump($infoVisio);
       //On va inserer l'id du medecin, l'id de la visio consulte, et la date d'archivage
       $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO archivagevisio (idMedecinArchivageConsulte,idVisioConsulte,DateArchivage)" . "VALUES(:id,:visio, now());");
        //On crée une boucle qui va permèttre d'ajouter l'un après l'autre les visio consultés
        foreach($infoVisio as $il){
            $bv1 = $pdoStatement->bindValue(':id', $id);
            // $infoVisio[$i]['idVisio'] on fait un compteur pour pouvoir y ajouter l'id de la visio consultés à x position
            $bvc1 = $pdoStatement->bindValue(':visio',$infoVisio[$i]['idVisio']);
            $i = $i +1;
             $executeOk = $pdoStatement->execute();
             
        }
        return $executeOk;
}
}
function voirVisioById($id){
    //On récupère toute les informations d'une visio en fonction de son id 
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM visioconference WHERE id = :id;");
    $bv1 = $pdoStatement->bindValue(':id', $id);
    if($pdoStatement->execute()){
       $resultat = $pdoStatement->fetch();
       return $resultat;
    }
    
}
function voirAllVisio(){
    //Recupère l'ensemble des visios présent dans la bdd
    $pdoStatement = PdoGsb::$monPdo->prepare("SELECT * FROM visioconference;");
    if($pdoStatement->execute()){
       $resultat = $pdoStatement->fetchAll();
       return $resultat;
    }
}
function donneMaintenance(): bool {
  //On recupère l'information 
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT bascule FROM maintenance");
    if ($monObjPdoStatement->execute()) {
        $maintenance=$monObjPdoStatement->fetch();
    }
    else
        throw new Exception("erreur dans la requête");
return $maintenance['bascule'];
}
function addInscriptionVisio($idMedecin, $idVisio){
    //L'utilisateur qu'il soit administrateur ou utilisateur peut s'inscrire à une visio 
    $pdo = PdoGsb::$monPdo;
    $requete = $pdo->prepare("INSERT INTO medecinvisio VALUES (:idMedecin, :idVisio, now());");
    $bv1 = $requete->bindValue(':idMedecin', $idMedecin, PDO::PARAM_INT);
    $bv2 = $requete->bindValue(':idVisio', $idVisio, pdo::PARAM_INT);
    
   return $requete->execute();
        
    
}
function updateVisio($idVisio, $nom, $objectif, $url, $dateVisio){
    

    
    $pdoStatement = PdoGsb::$monPdo->prepare("update visioconference set nomVisio = :nom,"
            . " objectif = :objectif, url = :url, dateVisio"
            . " = :dateVisio WHERE id= :id");
   $bvc1 = $pdoStatement->bindValue(':id',$idVisio,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nom', $nom, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':url', $url, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':dateVisio', $dateVisio, PDO::PARAM_STR);
    
    if ($pdoStatement->execute()) {
        $visio=$pdoStatement->fetch();
        return $visio;
    }
    else
        throw new Exception("erreur");
       
}
function deleteVisio($idVisio){
    
    $pdoStatement = PdoGsb::$monPdo->prepare("DELETE FROM visioconference WHERE id= :idVisio;");
    $bv1 = $pdoStatement->bindValue(':idVisio', $idVisio);
    if ($pdoStatement->execute()) {
        $visio=$pdoStatement->fetch();
        return $visio;
    }
    else
        throw new Exception("erreur");
    
}
function createVisio($nomVisio, $objectif, $url, $dateVisio){ 
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO visioconference VALUES (null,"
            . ":nomVisio, :objectif, :url ,:dateVisio)");
//    $bvc1 = $pdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    $bvc2 = $pdoStatement->bindValue(':nomVisio', $nomVisio, PDO::PARAM_STR);
    $bvc3 = $pdoStatement->bindValue(':objectif', $objectif, PDO::PARAM_STR);
    $bvc4 = $pdoStatement->bindValue(':url', $url, PDO::PARAM_STR);
    $bvc5 = $pdoStatement->bindValue(':dateVisio', $dateVisio, PDO::PARAM_STR);
    $executeOk = $pdoStatement->execute();
    return $executeOk;
       
}

}


?>