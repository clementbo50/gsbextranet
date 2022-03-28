<?php

require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");

$lePdo = PdoGsb::getPdoGsb();
$execution = $lePdo->createVisio("test", "test", "test", "0000-00-00");
var_dump($execution);
   
       

