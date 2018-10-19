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
	<body>
		<div class="container">
			<header class="header">
				<!-- Menu para inicio de sesión o registro -->
				<div class="navbar">
					<ul class="nav pull-right">
						<li><a href="login.php">Iniciar Sesión </a></li>
						<li><a href="Registrar.php">Registrarse </a></li>			 
					</ul>
				</div>
				<!-- Include para introducir carousel de imagenes -->
				<?php include ('cabecera.php');?>
			</header>

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
			
			<hr class="soften"/>
			<footer class="footer">

			<hr class="soften"/>
			<p>&copy; Copyright Keilor Jiménez<br/><br/></p>
			 </footer>
			</div>
			</style>
	</body>v
</html>