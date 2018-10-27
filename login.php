<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="keywords" content="" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	    <script src="bootstrap/js/jquery-1.8.3.min.js"></script>
	    <script src="bootstrap/js/bootstrap.min.js"></script>
	<title>Login</title>
</head>
<body background="images/fondotot.jpg" style="background-attachment: fixed" >
	<div class="container">
		<header class="header">
					<?php include ('cabecera.php');?>
		</header>

			<div class="navbar">
				<ul class="nav pull-right">
					<li><a href="index.php">Página Inicio</a></li>			 
				</ul>
			</div>
			<div class= "navbar">
				<ul class= "nav pull-right">
					<li><a href="register.php">Registrarme</a></li>
				</ul>
			</div>

		<center>
			<div class="tit">
				<h2 style="color: #; ">Inicio de sesión</h2>
			</div>
		<center>

		<table border="0" align="center" valign="middle">
			<form action="check_user.php" method="post">
				<tr>
					<td><label style="font-size: 14pt"><b>Usuario: </b></label></td>
					<td><input class="form-group has-success" style="border-radius:15px;" type="text" name="user"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Contraseña: </b></label></td>
					<td><input style="border-radius:15px;" type="password" name="pass"></td>
				</tr>
				<tr>
					<td height="30" align=center colspan="2">
						<input class="btn btn-danger" type="submit" value="Iniciar Sesión">
					</td>
	          	</tr> 
	          	<tr>
					<td height="30" align=center colspan="2">
						<a href="recovery_user.php">¿Olvido su contraseña?</a>			 
					</td>
				</tr>
		</table>

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<tr>
			<div>
				<footer align=left>
					<hr class="soften"/>
					<p>&copy; Copyright Keilor Jiménez</p>
					<hr class="soften"/>
				</footer>
			</div>
    </div>
    
</body>
</html>