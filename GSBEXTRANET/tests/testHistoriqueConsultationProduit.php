<?php
require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$lePdo = PdoGsb::getPdoGsb();


$execution = $lePdo->addHistoriqueConsultationProduit(24, 13);
var_dump($execution);

