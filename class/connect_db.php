<?php
//session_start();
$_SESSION['connect']= new MySQLi("localhost", "root","", "e-shopdb");
if ($_SESSION['connect'] -> connect_errno) {
	die( "Fallo la conexión a MySQL: (" . $_SESSION['connect'] -> mysqli_connect_errno() 
		. ") " . $_SESSION['connect'] -> mysqli_connect_error());
}
?>