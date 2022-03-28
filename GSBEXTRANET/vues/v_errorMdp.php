<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <center><h1>Page erreur : </h1></center>
    <br>   
       <p> Attention il vous faut un mot de passe contenant au moins 12 caractères, une majuscule, une minuscule et un caractère 
spécial.</p>
        <br>
         <form method="post" action="index.php?uc=modifDonnee&action=ErrorRetour">
           <center><input type="submit" name="btnRetour" value="Retour"></center>
            
            
        </form>    
            
        <?php
        // put your code here
        ?>
    </body>
</html>
