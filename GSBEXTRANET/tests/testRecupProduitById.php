<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$lePdo = PdoGsb::getPdoGsb();

var_dump($lePdo->recupProduitById(12));

