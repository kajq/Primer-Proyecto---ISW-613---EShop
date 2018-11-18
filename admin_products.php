<?php 
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
	$sku  		= isset($_GET["sku"])        ? $_GET["sku"] : "";
	$description= isset($_GET["description"])? $_GET["description"] : "";
	$price      = isset($_GET["price"])      ? $_GET["price"] : "";
	$in_stock   = isset($_GET["in_stock"])   ? $_GET["in_stock"] : 1;
	$image 		= isset($_GET["image"]) 	 ? $_GET["image"] :"";
	$category   = isset($_GET["category"])   ? $_GET["category"] :"";
	$id_category= isset($_GET["id_category"])? $_GET["id_category"] :"";
	$sum 		= isset($_GET["sum"])		 ? $_GET["sum"] : "";
	
    if ($action == 'insert') {
    	$oProducto->validate_image('');
    	$oProducto->insert_product();
    } elseif ($action == 'update') {
    	$oProducto->validate_image($image);
    	$oProducto->update_product($id);
    } elseif ($action == 'delete') {
    	echo '<script>
    	$confirm = confirm("¿Esta seguro de eliminar el producto ' . 
    	$description . '?")
    	</script> ';
    	if ($confirm == true) {
    		$oProducto->delete_product($id);
    	}
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
			<table border='0' class='table table-hover'>
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
			<?php 
				$oProducto->products_table(); 
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