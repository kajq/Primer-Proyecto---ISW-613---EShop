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
	<title>Formulario</title>
</head>
  <body background="images/fondotot.jpg" style="background-attachment: fixed" >
  	<center><div class="tit"><h2 style="color: #; ">Formulario de usuario</h2>
  	<center><div class="Ingreso">
      <tr>
      <td rowspan=2>
    	<table border="0" align="center" valign="middle">
      <form method="post" action="" >
          <div class="form-group">
            <label style="font-size: 14pt"><b>Nombre</b>
            <input type="text" name="name" class="form-control" required 
            placeholder="Ingresa tu nombre" /></label>
          </div>
          <div class="form-group">
            <label style="font-size: 14pt; color: #;"><b>Apellidos</b>
            <input type="text" name="lastname"  class="form-control" required 
             placeholder="Ingresa tus apellidos"/></label>
          </div>
          <div class="form-group">
            <label style="font-size: 14pt; color: #;"><b>Usuario</b>
            <input type="text" name="user" class="form-control"  required 
             placeholder="Ingresa usuario"/></label>
          </div>
          <div class="form-group">
            <label style="font-size: 14pt; color: #;"><b>Número teléfono</b>
            <input type="number" name="phone" class="form-control"  required 
            placeholder="Ingresa tu número"/></label>
          </div>
          <div class="form-group">
            <label style="font-size: 14pt; color: #;"><b>Correo Electronico</b>
            <input type="email" name="email" class="form-control"  required 
            placeholder="Ingresa tu email"/></label>
          </div> 
        </div>
       
    <?php
    session_start();
    require("users.php");
     $user = new users();
      if ($user->Accion == "Registrar"){
      echo "<input  class='btn btn-primary' type='submit' name='new' value='Registrarse'/> </form>" ;
      echo "<form action=\"index.php\"><input class=\"btn btn-danger\" type=\"submit\" value=\"Cancelar\"> </form>";	
      }else if ($this->Accion == "Editar"){
      echo "<input  class='btn btn-primary' type='submit' name='update' value='Actualizar'/> </form>";
      echo "<form action=\"dashboard.php\"><input class=\"btn btn-danger\" type=\"submit\" value=\"Cancelar\"> </form>";
      } else{
        echo 'Error al registrar';
        echo 'header("Location: index.php")';
      }
      if(isset($_POST['new'])){
        $user->check_mail();
        if ($user->email_exist == false) {
          $user->get_pass();
          $user->insert_user();
          $user->sendemail(); 
        }  
      }
      if(isset($_POST['update'])){
          require("ejecutaactualizar.php");
      }
    	?>

    </div>
  		</td>
      </tr>
  		</table>
  		</div></center></div></center>
  </body>
</html>