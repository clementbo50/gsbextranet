<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$pdo = PdoGsb::getPdoGsb();
//var_dump($pdo->voirVisioById(1));


var_dump($pdo->voirAllVisio());

