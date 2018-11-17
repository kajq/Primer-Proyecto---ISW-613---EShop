<?php	
session_start();
include ("class\sales.php");
include ("class/products.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder comprar")</script> ';
		//echo "<script>location.href='../index.php'</script>";	
	}
extract($_GET);
$oSale = new sales();
$oProduct = new products();
$action	    = isset($_GET["action"])     ? $_GET["action"] : "";
if ($action == 'new') {
	$oSale->check_cart();
}
$customer = $oSale->customer();
$cart 	  = $oSale->cart();
$products = $oSale->products_cart($cart['id_sale']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>E-Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Keilor Jiménez">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="bootstrap/js/jquery-1.8.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</head>
	<body background="images/fondotot.jpg" style="background-attachment: fixed">
		<div class="container">
			<header class="header">
				<?php include ('include/cabecera.php');?>
			</header>
			<div>
				<?php include ('include/menu.php'); ?>
			</div>
			<br><br>
			<div class = "nav-collapse">
				<?php 	if ($action == 'details') {
					include ('include\product_details.php');
				} ?>
				<table>
					<tr>
						<td colspan="4"><h2>Tienda Electronica KAJQ S.A.</h2></td>
					</tr>
					<tr>
						<td colspan="4"><h4>www.e-shop.cpm</h4></td>
					</tr>
					<tr>
						<td><label>Nombre Cliente:</label></td>
						<td><input type="text" readonly value="<?php echo $customer['name'] . " " . $customer['last_name']; ?>"></td>
						<td><label>Fecha:</label></td>
						<td><input type="text" readonly data-date='' data-date-format="DD MMMM YYYY" value="<?php echo $customer['date']; ?>"></td>
					</tr>
					<tr>
						<td><label>Correo Electronico</label></td>
						<td><input type="email" readonly value="<?php echo $customer['email']; ?>"></td>
						<td><label>Teléfono</label></td>
						<td><input type="number" readonly value="<?php echo $customer['phone']; ?>"></td>
					</tr>
				</table>
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>SKU</td>
					<td>Detalle</td>
					<td>Cantidad</td>
					<td>Subtotal</td>
					<td>Total</td>
					<td>Eliminar</td>
				</tr>
				<?php $cont = 0;
				for ($i=0; $i < count($products)/6; $i++) { ?>
				<tr>
					<td><?php echo "<a href='shopping_car.php?action=details&id=" . $products['sku='.$cont] . "' >" . $products['sku='.$cont] . "</a> <br/>"; ?></td>
					<td><?php echo $products['description='.$cont]; ?></td>
					<td><?php echo $products['sum='.$cont];
					if ($products['sum='.$cont] > $products['in_stock='.$cont]) {
						echo " <img src='..\images\alert.png' width='20' title='No alcanza esta cantidad de producto en bodega'>";
					} else {
						echo " <img src='..\images\\new.png' width='20' title='Más de este producto'>";
					} ?>
					<img src="..\images\minus.png" width="20" title="Menos de este producto"> </td>
					<td><?php echo "₡".$products['price='.$cont]; ?></td>
					<td><?php echo "₡".$products['price='.$cont]*$products['sum='.$cont]; ?></td>
				</tr>
				<?php 
					$cont++;
				}
				if ($cont == 0) {
					echo "<tr><td colspan='6'><label>No hay productos en lista de deseos</label></td></tr>";
				}
				 ?>
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