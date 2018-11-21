<?php   
require("class/users.php");
$user = new users();
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
  	<title>Formulario</title>
  </head>
  <body background="images/fondotot.jpg"style="background-attachment: fixed" >
    <div class="container">
      <header class="header">
          <?php include ('include/cabecera.php');?>
      </header>
    	<center>
        <div class="tit"><h2 style="color: #; ">Formulario de usuario</div>
    	<div class="Ingreso">
      <table border="0" align="center" valign="middle">
        <form method="post" action="" >
        <tr>
          <td>
            <label style="font-size: 14pt; color: #;"><b>Usuario</b></label>
          </td>
          <td>
            <input type="text" name="user" class="form-control"  required
               placeholder="Ingresa usuario" <?php if ($user->Accion == "Editar") {
                 echo 'readonly ';
              }echo 'value='.$user->user; ?> >
          </td>
        </tr>
        <tr>
          <td>
            <label style="font-size: 14pt"><b>Contraseña</b></label>
          </td>
          <td>
            <input type="password" name="pass" class="form-control" required 
              placeholder="Contraseña" value='<?php echo $user->password ?>' >
          </td>
        </tr>
        <tr>
          <td>
            <label style="font-size: 14pt"><b>Confirmar contraseña</b></label>
          </td>
          <td>
            <input type="text" name="pass_confirm" class="form-control" required 
              placeholder="Confirmar Contraseña">
          </td>
        </tr>
        <tr>
          <td>
            <label style="font-size: 14pt"><b>Nombre</b></label>
          </td>
          <td>
            <input type="text" name="name" class="form-control" required 
              placeholder="Ingresa tu nombre" value='<?php echo $user->name ?>' >
          </td>
        </tr>
        <tr>
          <td>
           <label style="font-size: 14pt; color: #;"><b>Apellidos</b></label>
          </td>
          <td>
            <input type="text" name="lastname"  class="form-control" required
               placeholder="Ingresa tus apellidos" value='<?php echo $user->lastname ?>' >
          </td>
        </tr>
        <tr>
          <td>
            <label style="font-size: 14pt; color: #;">
              <b>Número teléfono</b>
            </label>
          </td>
          <td>
            <input type="number" name="phone" class="form-control"  required 
              placeholder="Ingresa tu número" value='<?php echo $user->phone ?>' >
          </td>
        </tr>
        <tr>
          <td>
            <label style="font-size: 14pt; color: #;">
              <b>Correo Electronico</b>
            </label>
          </td>
          <td>
            <input type="email" name="email" class="form-control"  required 
              placeholder="Ingresa tu email" value='<?php echo $user->email ?>'>
          </td>
        </tr>
        <tr>         
        <?php
          if ($user->Accion == "Registrar"){
            echo "<td><input  class='btn btn-primary' type='submit' name='new' value='Registrarse'/> </td>" ;
          }else if ($user->Accion == "Editar"){
            echo "<td><input  class='btn btn-primary' type='submit' name='update' value='Actualizar'/> </td>";
          } else{
            echo 'Error al registrar';
            echo "<script>location.href='index.php'</script>";
          }

          echo "<td><input class='btn btn-danger' type='submit'   value='Cancelar'  onclick=\"window.location.href='index.php'\"</form>";

          if(isset($_POST['new'])){
            if ($user->check_pass() == true) {
                $user->check_mail();
                if ($user->email_exist == false) {
                  $user->insert_user();
                  $user->sendemail(); 
                  echo "<script>location.href='index.php'</script>";
                } else {
                  echo '<script>alert("Correo ya esta registrado!")</script> ';      
                }
              } 
          }
          if(isset($_POST['update'])){
              if ($user->check_pass() == true) {
                $user->update_user();
                $user->sendemail(); 
                require("class/check_user.php");
                $init = new check_user();
                $init->check_userdb();
                echo "<script>location.href='index.php'</script>";
              }
              
          }
          if (isset($_POST['cancel'])) {
            echo "<script>location.href='index.php'</script>";
          }
        	?>
          </td>
        </tr>
    	</table>
    	</div>
      </center>
  </body>
</html>