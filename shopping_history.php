<?php 	
session_start();
include ("class\purchases.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder acceder aqui")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}
$user = $_SESSION['username'];
$rol  = $_SESSION['rol'];
$oPurchase = new purchases();
$purchases = $oPurchase->select_purchases($user);
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
			<?php if ($rol > 0) { ?>
				<div class = "nav-collapse">
					<h3>Estadisticas del Administrativas</h3>
					<table>
						<tr>
							<td>Usuarios Registrados</td>
							<td><input type="number" readonly value="<?php echo $oPurchase->total_users();	 ?>"></td>
						</tr>
						<tr>
							<td>Productos Vendidos</td>
							<td><input type="number" readonly value="<?php echo $oPurchase->total_products('admin');	 ?>"></td>
						</tr>
						<tr>
							<td>Total de Ventas</td>
							<td><input type="text" readonly value="<?php echo '₡'.$oPurchase->total_sales('admin');	 ?>"></td>
						</tr>
					</table>
				</div>
			<?php 	} ?>
			<div class = "nav-collapse">
				<h3>Historial de compras del usuario</h3>
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>#Factura</td>
					<td>Fecha</td>
					<td>Cliente</td>
					<td>Cantidad <br>Productos</td>
					<td>Total</td>
					<td>Detalles</td>
				</tr>
				<?php 
				if (count($purchases) == 0) {
					echo "<td>No hay compras registras por el usuario</td>";
				}{
				for ($i=0; $i < count($purchases)/6; $i++) { ?>
				<tr>
					<td><?php echo $purchases['id='.$i] ?></td>
					<td><?php echo $purchases['date='.$i] ?></td>
					<td><?php echo $purchases['name='.$i]. " " . $purchases['last_name='.$i] ?></td>
					<td><?php echo $purchases['sum='.$i] ?></td>
					<td><?php echo '₡'.$purchases['total='.$i] ?></td>
					<td><a <?php echo "href='../purchase_details.php?id_sale=" . $purchases['id='.$i] . "'" ?> >
                        <img src="..\images\search.png" width="30" title="Eliminar"> 
                    	</a></td>
				</tr>
				<?php }} ?>
				<tr>
					<td colspan="2"></td>
					<td><h4>Total</h4></td>
					<td><h4><?php echo $oPurchase->total_products($user);?></h4></td>
					<td><h4><?php echo $oPurchase->total_sales($user);	 ?></h4></td>
				</tr>
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
