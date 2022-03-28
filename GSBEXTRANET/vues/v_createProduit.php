<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extrane</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/produit.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
       
  </head>
    <body background="assets/img/laboratoire.jpg">
        
         <div class="page-content container">
	              <div class="row">
		            <div class="col-md-4 col-md-offset-4">
			          <div class="login-wrapper">
				        <div class="box">
					   <div class="content-wrap">
						<legend>Ajouter un produit </legend>
							<form method="post" action='index.php?uc=produits&action=createProduit'>
                                                             <input type='text' name='nom' value="Nom du produit">
                                                             <br>
                                                             <input type='text' name='objectif' value="Objectif">
                                                             <br>
                                                             <input type='text' name='information' value="Information">
                                                             <br>
                                                             <input type='text' name='effet' value="Effet indésirable">
                                                               <br>
                                                              <br>
                                                              
                                                             <input type='submit' name='btnCreateProduit' value='Ajouter'>
                                                              <input type='submit' name='btnRetourProduit' value='Retour'>
                                                        </form>
                                                <br>
                                                
                                             </div>	
                                     
                                    
				        </div>
			            </div>
		            </div>
	                </div>
                    </div>
        
              
                

        </
        
        
</html>

