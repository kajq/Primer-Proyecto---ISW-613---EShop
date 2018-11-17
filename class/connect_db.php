<?php
$_SESSION['connect']= new MySQLi("localhost", "root","", "eshopdb");
if ($_SESSION['connect'] -> connect_errno) {
	die( "Fallo la conexión a MySQL: (" . $_SESSION['connect'] -> mysqli_connect_errno() 
		. ") " . $_SESSION['connect'] -> mysqli_connect_error());
}
?>