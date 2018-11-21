<?php //Cronjob para enviar notificaciones con productros bajos en stock
//Se incluye la logica del cronjob
include ("class/cronjob_class.php");
//se validan los parametros minimos
if ($argc < 2 ) {exit( "Instrucciones: Debe digitar la cantidad minima de productos y correo electronico" );}

$oCornjob = new cronjob_class($argv[1], $argv[2]);
$products = $oCornjob->search_min();
$oCornjob->sendemail();

 ?>