<?php 	
session_start();
include ("class\purchases.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder acceder aqui")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}
$oPurchase = new purchases();
$purchases = $oPurchase->select_purchases();
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
			<br><br>
			<div class = "nav-collapse">
				<h3>Historial de compras del usuario</h3>
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>#Factura</td>
					<td>Fecha</td>
					<td>Cliente</td>
					<td>Total</td>
					<td>Detalles</td>
				</tr>
				<?php 
				if (count($purchases) == 0) {
					echo "<td>No hay compras registras por el usuario</td>";
				}{
				for ($i=0; $i < count($purchases)/5; $i++) { ?>
				<tr>
					<td><?php echo $purchases['id='.$i] ?></td>
					<td><?php echo $purchases['date='.$i] ?></td>
					<td><?php echo $purchases['name='.$i]. " " . $purchases['last_name='.$i] ?></td>
					<td><?php echo '₡'.$purchases['total='.$i] ?></td>
					<td><a <?php echo "href='../purchase_details.php?id_sale=" . $purchases['id='.$i] . "'" ?> >
                        <img src="..\images\search.png" width="30" title="Eliminar"> 
                    	</a></td>
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
