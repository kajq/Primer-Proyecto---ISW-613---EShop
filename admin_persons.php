<?php 	
session_start();
include ("class\persons.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder acceder aqui")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}
extract($_GET);
$action	    = isset($_GET["action"])     ? $_GET["action"] : "";
$user  		= isset($_GET["user"])        ? $_GET["user"] : "";
$value 		= isset($_GET["value"])        ? $_GET["value"] : "";
$oPerson = new persons();
$persons = $oPerson->select();
if ($action == 'rol') {
	$oPerson->change_rol($user, $value);
}
 ?>
<html>
<head>
	<meta charset="utf-8">
	<title>E-Shop</title>
	<meta name="viewport" ient="width=device-width, initial-scale=1.0">
    <meta name="description" ient="">
    <meta name="author" ient="Keilor Jiménez">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="bootstrap/js/jquery-1.8.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</head>
	<body background="images/fondotot.jpg" style="background-attachment: fixed">
		<div class="Container">
			<header class="header">
				<?php include ('include/cabecera.php');?>
			</header>
			<div>
				<?php include ('include/menu.php'); ?>
			</div>
			<div class = "nav-collapse">
				<h3>Usuarios Registrados</h3>
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>Usuario</td>
					<td>Nombre</td>
					<td>Teléfono</td>
					<td>Correo</td>
					<td>Estado</td>
					<td>Tipo Usuario</td>
				</tr>
				<?php 
				if (count($persons) == 0) {
					echo "<td>No hay usuarios registrados</td>";
				}{
				for ($i=0; $i < count($persons)/8; $i++) { ?>
				<tr>
					<td><?php echo $persons['user='.$i] ?></td>
					<td><?php echo $persons['name='.$i]. " " . $persons['last_name='.$i] ?></td>
					<td><?php echo $persons['phone='.$i] ?></td>
					<td><?php echo $persons['email='.$i] ?></td>
					<td><?php echo $persons['state='.$i] ; ?></td>
					<td><?php echo "<a href='admin_persons.php?action=rol&user=".$persons['user='.$i] ."&value=".$persons['rol='.$i]."'><img src='../images/change.jpg' width='30' title ='Cambiar' ></a>" . $persons['drol='.$i];?></td>
					</tr>
				<?php }} ?>
			</table>
			<hr/>
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
			</style>
	</body>
</html>
