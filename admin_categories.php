<?php 
	session_start();
	if (@!$_SESSION['username'] || $_SESSION['rol'] <> '1') {
		echo '<script>alert("Usuario no autorizado!!")</script> ';
		echo "<script>location.href='index.php'</script>";	
	}
	include ('class/categories.php');
	$oCategoria = new categories();
	extract($_GET);
	$action	   = isset($_GET["action"]) ? $_GET["action"] : "";
	$category  = isset($_GET["category"]) ? $_GET["category"] : "";
	$id_superc = isset($_GET["id_superc"]) ? $_GET["id_superc"] : "";
	$superc    = isset($_GET["superc"]) ? $_GET["superc"] : "";
	$state     = isset($_GET["state"]) ? $_GET["state"] : 1;
	$id 	   = isset($_GET["id"]) ? $_GET["id"] : "algo";
	$confirm = True;
	if ($state == 0) {$check_state = "";} else {$check_state = "checked";}
    if ($action == 'insert') {
    	$oCategoria->insert_category();
    } elseif ($action == 'update') {
    	$oCategoria->update_category($id);
    } elseif ($action == 'delete') {
    	echo '<script>
    	$confirm = confirm("¿Esta seguro de eliminar la categoria ' . $category . '?")
    	</script> ';
    	if ($confirm == true) {
    		$oCategoria->delete_category($id);
    	}
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
				<h3>Categorias de Productos  
					<a href="../admin_categories.php?action=new">
                        <img src='images/new.png' title="Nueva Categoria" width="25" />
                    </a>
                </h3>
	                <?php 
                if ($action == 'new' || $action == 'edit') {
                	$action = 'insert';
                	include ('include/form_category.php');
                } ?>		
			</div>
			<table border='0' class='table table-hover'>
				<tr class='warning'>
					<td>Categoria Padre</td>
					<td>Categoria</td>
					<td>Estado</td>
					<td>Editar</td>
					<td>Eliminar</td>
				</tr>
			<?php 
				$oCategoria->category_table(); 
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