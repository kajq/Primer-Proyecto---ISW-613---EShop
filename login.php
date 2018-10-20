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
	<title>Login</title>
</head>
<body background="images/fondotot.jpg" style="background-attachment: fixed" >
	<center>
		<div class="tit">
			<h2 style="color: #; ">Inicio de sesión</h2>
		</div>
	<center>

	<table border="0" align="center" valign="middle">
		<form action="validar.php" method="post">
			<tr>
				<td><label style="font-size: 14pt"><b>Correo: </b></label></td>
				<td><input class="form-group has-success" style="border-radius:15px;" type="text" name="mail"></td>
			</tr>
			<tr>
				<td><label style="font-size: 14pt"><b>Contraseña: </b></label></td>
				<td witdh=80><input style="border-radius:15px;" type="password" name="pass"></td>
			</tr>
			<tr>
				<td width=80 align=center>
					<input class="btn btn-danger" type="submit" value="Iniciar Sesión">
				</td>
      			<td width="80" align=center>
          			<input class="btn btn-danger" type="submit" name="Accion" value="Registrar Usuario">
          		</td>
          	</tr> 
          	<tr>
        		<td height="50" align=center>
		          <input class="btn btn-danger" type="submit" name="Accion" value="Recuperar Cuenta">
		        </td>
		        <td height="50" align=center>
		        	<input class="btn btn-danger" type="submit" name="Accion" value="Página Inicio">
		        </td>
      		</tr>
	</table>
</body>
</html>