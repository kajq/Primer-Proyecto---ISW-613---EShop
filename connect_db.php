<?php
$_SESSION['connect']= new MySQLi("localhost", "root","", "e-shopdb");
if ($_SESSION['connect'] -> connect_errno) {
	die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
		. ") " . $mysqli -> mysqli_connect_error());
}
?>