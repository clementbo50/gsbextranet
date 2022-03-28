<?php
if(isset($_GET['accepte'])){
    setcookie('accepte', 'true', time() + 365*24*3600);
    header('Location:./');
    die();
}
?>

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
        <link href="css/banniere.css" rel="stylesheet">
    </head>
    <body >
        
      <?php
      if(!isset($_COOKIE['accepte'])){
      
      
      ?>
       <div class="banniere">
                <div class="text-banniere">
                    <p>Notre site utilisent des cookies</p>
                </div>
                <div class="button-banniere">
                    <a href="?accepte">j'accepte</a>
                    
                </div>
        </div>
      <?php
      }
      ?>
    </body>
</html>
