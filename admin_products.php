<?php //Pantalla de adminsitración de productos
	session_start();
	if (@!$_SESSION['username'] || $_SESSION['rol'] == '0') {
		echo '<script>alert("Usuario no autorizado!!")</script> ';
		echo "<script>location.href='index.php'</script>";	
	}
	include ('class/products.php');
	$oProducto = new products();
	extract($_GET);
	$action	    = isset($_GET["action"])     ? $_GET["action"] : "";
	$id  		= isset($_GET["id"])        ? $_GET["id"] : "";
	$img  		= isset($_GET["img"])        ? $_GET["img"] : "";
	
    if ($action == 'insert') {
    	$oProducto->validate_image('');
    	$oProducto->insert_product();
    } elseif ($action == 'update') {
    	$oProducto->validate_image($img);
    	$oProducto->update_product($id);
    } elseif ($action == 'delete') {
    	$oProducto->delete_product($id);
    } elseif ($action == 'plus') {
    		$oProducto->plus_product($id, $in_stock);
    } 
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
				<h3>Lista de Productos  
					<a href="../admin_products.php?action=new">
                        <img src='images/new.png' title="Nueva Categoria" width="25" />
                    </a>
                </h3>
	                <?php 
                if ($action == 'new' || $action == 'edit') {
                	//$action = 'insert';
                	include ('include/form_product.php');
                } ?>		
			</div>
			<table class='table table-hover'>
				<tr class='warning'>
					<td>Imagen</td>
					<td>SKU</td>
					<td>Detalle</td>
					<td>Precio</td>
					<td>Cantidad</td>
					<td>Categoria</td>
					<td>Editar</td>
					<td>Borrar</td>
				</tr>
			<?php //$oProducto->products_table(); 
			$products = $oProducto->select('','','');
			for ($i=0; $i < count($products)/8; $i++) { ?>
				<tr class='success'>
					<td> <?php echo "<img src='/images/uploads/".$products['img='.$i]."' class='img-rounded' width='100' alt='' />"; ?></td>
					<td> <?php echo $products['sku='.$i]; ?></td>
					<td> <?php echo $products['description='.$i]; ?></td>
					<td>₡<?php echo $products['price='.$i]; ?></td>
					<td> <?php echo $products['in_stock='.$i] . "<a href='admin_products.php?action=plus&id=".$products['id='.$i] ."&in_stock=".$products['in_stock='.$i]."'><img src='../images/new.png' width='15'>" ; ?> 
					</td>
					<td> <?php echo $products['category='.$i] ; ?> </td>
					<td> <?php echo "<a href='admin_products.php?action=edit&id=" .  $products['id='.$i] . "'><img src='../images/update.jpg' class='img-rounded' width='25'>";?>
					</td>
					<td> <a <?php 	echo " href='admin_products.php?action=delete&id=" .$products["id=".$i] . "&description=" . $products['description='.$i] . "'><img src='../images/delete.png' class='img-rounded' width='25'"; ?> onclick="return 				confirm('¿Esta seguro de eliminar este producto?')" > </td>
				</tr>
			<?php } ?>
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