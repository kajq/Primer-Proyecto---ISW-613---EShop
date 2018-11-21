<?php	//pantalla para ver los detalles de compras seleccionadas
session_start();
include ("class\sales.php");
include ("class\products.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder ingresar")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}
extract($_GET);
$id_sale  = isset($_GET["id_sale"]) ? $_GET["id_sale"] : "";
$oSale 	  = new sales();
$oProduct = new products();
$customer = $oSale->customer();
$cart 	  = $oSale->cart($id_sale);
$products = $oSale->products_cart($id_sale);
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
				<table>
					<tr>
						<td colspan="4"><h2>Tienda Electronica KAJQ S.A.</h2></td>
					</tr>
					<tr>
						<td>
							<h4>
								Reimpresión de Factura
							</h4>
						</td>
						<td colspan="4"><h4> www.e-shop.cpm</h4></td>
					</tr>
					<tr>
						<form action="/shopping_car.php?action=to_buy" method="post">
						<td><label>Nombre Cliente:</label></td>
						<td><input type="text" readonly value="<?php echo $customer['name'] . " " . $customer['last_name']; ?>"></td>
						<td><label>Fecha:</label></td>
						<td><input type="text" readonly data-date='' data-date-format="DD MMMM YYYY" value="<?php echo $cart['sale_date']; ?>"></td>
					</tr>
					<tr>
						<td><label>Correo Electronico</label></td>
						<td><input type="email" readonly value="<?php echo $customer['email']; ?>"></td>
						<td><label>Teléfono</label></td>
						<td><input type="number" readonly value="<?php echo $customer['phone']; ?>"></td>
						</form>
					</tr>
				</table>
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>SKU</td>
					<td>Detalle</td>
					<td>Cantidad</td>
					<td>Precio</td>
					<td>Sub Total</td>
				</tr>
				<?php 
				$cont = 0;
				$total = 0;
				for ($i=0; $i < count($products)/7; $i++) { ?>
				<tr>
					<td><?php echo "<a href='shopping_car.php?action=details&id=" . $products['sku='.$cont] . "' >" . $products['sku='.$cont] . "</a> <br/>"; ?></td>
					<td><?php echo $products['description='.$cont]; ?></td>
					<td><?php echo $products['sum='.$cont]; ?>		</td>
					<td><?php echo "₡".$products['price='.$cont]; ?></td>
					<td><?php echo "₡".$products['total='.$cont]; ?></td>
					</tr>
				<?php 
					$total = $total + $products['total='.$cont];
					$cont++;
				}
				 ?>
				 <tr>	
				 	<td colspan="3"></td>
				 	<td><h4>Total</h4></td>
				 	<td colspan="2"><h4><?php echo "₡".$total ?></h4></td>
				 </tr>
			</table>
			<h5><a href='../shopping_history.php'> <img src='..\images\return.jpg' width='30' title='Volver'>Volver</a></h5>
			<hr/>
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
			</style>
	</body>
</html>