<?php
session_start();
require("connect_db.php");
$init = new check_user();
$init->check_userdb();

class check_user{

	private $user;
	private $pass;
	private $connect_db;

	//COntructor obtiene datos de post de un formulario (login y register)
	function check_user(){
		$this->user=		$_POST['user'];
		$this->pass=		$_POST['pass'];
		$this->connect_db = $_SESSION['connect'];
	}	

	//función verifica que usuario y contraseña se encuentre en BD
	function check_userdb(){
	$qUsers = "SELECT u.user, p.name, p.last_name, p.phone, p.email, u.password, u.rol 
				FROM users u
				LEFT JOIN person p
				ON u.user = p.user
				WHERE u.user = '$this->user' and u.password = '$this->pass'";
	//la variable  $mysqli viene de connect_db
	$execute=mysqli_query($this->connect_db, $qUsers);
	$_SESSION['rol'] = '';
	if($user = mysqli_fetch_assoc($execute)){ //en caso de si asigna valores al session
		$_SESSION['username'] =	$user['user'];
		$_SESSION['pass'] =	$user['password'];
		$_SESSION['rol']	  =	$user['rol'];
		$_SESSION['name']	  =	$user['name'];
		$_SESSION['last_name']= $user['last_name'];
		$_SESSION['email']	  = $user['email'];
		$_SESSION['phone']	  = $user['phone'];	

	}elseif ($this->user == 'admin' && $this->pass == '123456789') {
//de no encontrarse en la base datos tambien valida este usuario admin predeterminado
		$_SESSION['username'] =	$this->user;
		$_SESSION['rol']	  =	2;
	}	else{
		//si el admin tampoco coincide da mensaje de error de usuario
		echo '<script>alert("Usuario o Contraseña incorrecto!")</script> ';
		echo "<script>location.href='../login.php'</script>";	
	}
	//Si el login dio resultado verifica si es administrador y da un mensaje
	if($_SESSION['rol'] > 0){
		echo '<script>alert("Bienvenido administrador")</script> ';
		}
		//finanlemnte redirecciona la pagina
		echo "<script>location.href='../shopping_history.php'</script>";
	}
}	
?>