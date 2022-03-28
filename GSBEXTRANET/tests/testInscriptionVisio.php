<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$lePdo = PdoGsb::getPdoGsb();

$execute = $lePdo->addInscriptionVisio(6, 1);
var_dump($execute);