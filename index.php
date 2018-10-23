<?php 
  session_start();
  require("connect_db.php");
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
    <script src="bootstrap/js/jquery-1.8.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</head>
	<body background="images/fondotot.jpg" style="background-attachment: fixed">
		<div class="container">
			<header class="header">
				<?php include ('cabecera.php');?>
			</header>

			<div class="navbar">
				<ul class="nav pull-right">
					<li><a href="login.php">Iniciar Sesión</a></li>			 
				</ul>
			</div>
			<div class= "navbar">
				<ul class= "nav pull-right">
					<li><a href="register.php">Registrarme</a></li>
				</ul>
			</div>

			<h3>Te ofrecemos las las siguientes categorias de productos</h3>
			<div class="row" style="text-align:center">
				<div class="span2">
					<div class="well well-small">
						<h4>Categoria1</h4>
						<a href="al.php"><small>Ver detalles</small></a>
					</div>
				</div>
				
				<div class="span2">
					<div class="well well-small">
						<h4>Categoria2</h4>
						<a href="te.php"><small>Ver detalles</small></a>
					</div>
				</div>
				<div class="span2">
					<div class="well well-small">
						<h4>Categoria 3</h4>
						<a href="fi.php"><small>Ver detalles</small></a>
					</div>
				</div>			
			</div>

			<h3>Nuestros productos más vendidos</h3>
			<div class="row">

				<div class="span4">
					<div class="thumbnail">
					<h3 style="text-align:center">Producto 1</h3>	
					<img src="images/algebra.jpg" alt="#"/>
						<div class="caption">
							<h5>Descripción del Curso</h5>	
							<a class="pull-right" href="al.php">Ver detalles</a>
							<br/>
						</div>
					</div>
				</div>

				<div class="span4">
					<div class="thumbnail">
					<h3 style="text-align:center">Producto 1</h3>	
					<img src="images/algebra.jpg" alt="#"/>
						<div class="caption">
							<h5>Descripción del Curso</h5>	
							<a class="pull-right" href="al.php">Ver detalles</a>
							<br/>
						</div>
					</div>
				</div>

				<div class="span4">
					<div class="thumbnail">
					<h3 style="text-align:center">Producto 1</h3>	
					<img src="images/algebra.jpg" alt="#"/>
						<div class="caption">
							<h5>Descripción del Curso</h5>	
							<a class="pull-right" href="al.php">Ver detalles</a>
							<br/>
						</div>
					</div>
				</div>

			</div>
			<hr/>
			
			<footer>
				<p>&copy; Copyright Keilor Jiménez</p>
				<hr class="soften"/>
			</footer>
			</div>
			</style>
	</body>v
</html>