<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extrane</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <<link rel="stylesheet" href="css/produit.css"/>

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
						<legend>Supression du compte</legend>
                                                <p>Attention si vous cliquer sur ces boutons votre compte sera supprimé ! </p>
							<form method="post" action="index.php?uc=supression&action=supressionCompte">
                                                            <br>
                                                            <br>
                                                            <input type='submit' name='btnSupression' value='Supprimer'>
                                                            
                                                            <p>ou</p>
                                                            
                                                             <form method="post" action="index.php?uc=supression&action=Archiver">
                                                               <input type='submit' name='btnArchiver' value='Archiver'>
                                                              </form>

                                                           
                                                           
                                                            

								
                                                        </form>
                                                
                                               
                                                
                                        </div>	
                                     
                                   
				</div>
			</div>
		</div>
	</div>
</div>
        
    <form method="post" action="index.php?uc=produits&action=retourSommaire">
                                                    <input type="submit" name="btnModifProduit" value="Retour" class="btnModifierProduit">
                                                </form>
    </body>
</html>

