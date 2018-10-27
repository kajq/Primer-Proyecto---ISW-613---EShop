<?php
session_start();
require("connect_db.php");
$init = new check_user();
$init->check_userdb();

class check_user{

	private $user;
	private $pass;
	private $connect_db;

	function check_user(){
		$this->user=		$_POST['user'];
		$this->pass=		$_POST['pass'];
		$this->connect_db = $_SESSION['connect'];
	}	

	function check_userdb(){
	$qUsers = "SELECT u.user, p.name, p.last_name, p.phone, p.email, u.password, u.rol 
				FROM users u
				LEFT JOIN person p
				ON u.user = p.user
				WHERE u.user = '$this->user' and u.password = '$this->pass'";
	//la variable  $mysqli viene de connect_db
	$execute=mysqli_query($this->connect_db, $qUsers);

	if($user = mysqli_fetch_assoc($execute)){
		$_SESSION['username'] =	$user['user'];
		$_SESSION['rol']	  =	$user['rol'];
		$_SESSION['name']	  =	$user['name'];
		$_SESSION['last_name']= $user['last_name'];
		$_SESSION['email']	  = $user['email'];
		
		if($user['rol']=='1'){
			echo '<script>alert("Bienvenido administrador")</script> ';
		}
		echo "<script>location.href='index.php'</script>";	

	}else{
		echo '<script>alert("Usuario o Contraseña incorrecto!")</script> ';
		echo "<script>location.href='login.php'</script>";	
	}
	}
}	
?>