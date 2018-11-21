<?php
session_start();
require("connect_db.php");
class users{

	private $connect_db;
	public $Accion;
	public $user;
	public $name;
	public $lastname;
	public $phone;
	public $email;
	public $password;
	public $email_exist;

//Constructor valida si se esta registrando o editando un usurio y carga las variables
	function users(){
		$this->connect_db = $_SESSION['connect'];
		if (@!$_SESSION['username']) {
		    $this->Accion=    "Registrar";
		    $this->user=		"";
			$this->password =   "";
			$this->name=		"";
			$this->lastname =	"";
			$this->phone = 		"";
			$this->email = 		"";
		} else {
		    $this->Accion=    "Editar";
		    $this->user =     $_SESSION['username'];
		    $this->password = $_SESSION['pass'];
		    $this->name =     $_SESSION['name'];
		    $this->lastname = $_SESSION['last_name'];
		    $this->phone =    $_SESSION['phone'];
		    $this->email =    $_SESSION['email'];
		}
	}

	//Función que verifica que el email no exista en la bd
	function check_mail(){
		$this->email    =	$_POST['email'];
		$qMails  = ("SELECT email FROM person WHERE email = '$this->email'");
		$execute = mysqli_query($this->connect_db, $qMails);

		if($exists = mysqli_fetch_assoc($execute)){
			echo '<script>alert("Error: Correo ya esta asignado a un usuario, verifique sus datos")</script> ';	
			$this->email_exist = true;
		} else {
			$this->email_exist = false;
		}
	}

	//Función que verifica las contraseñas del formulario sean iguales
	function check_pass(){
		$check = true;
		if ($_POST['pass'] <> $_POST['pass_confirm']) {
			echo '<script>alert("Contraseñas no coinciden")</script> ';      
			$check = false;
		} 
		return $check;
	}

	//función que llama otra función que envia un correo de confirmación
	function sendemail(){
		include("sendemail.php");//Llama la funcion para enviar el correo electronico
		$template="email_template.html";//Ruta de la plantilla correo
		$txt_message="Se ha creado exitosamente su usuario en www.e-shop.com, su tienda online preferida.";
		$mail_subject="Usuario Registrado exitosamente";
		
		sendemail($this->email, $this->name, $this->email, $txt_message, $mail_subject, $template);//Enviar el mensaje
	}

	//funcion que inserta en la tabla user y person cuando se registra un usuario
	function insert_user(){
		//se capturan los parametros del post
	   	$this->user     =	$_POST['user'];
		$this->name 	=	$_POST['name'];
		$this->lastname =	$_POST['lastname'];
		$this->phone    =	$_POST['phone'];
		$this->email    =	$_POST['email'];
		$this->password =   $_POST['pass'];

		$qInsert = "INSERT INTO person VALUES('$this->user','$this->name', '$this->lastname', '$this->phone', '$this->email')";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo '<script>alert("Error al insertar datos personales: ';
			echo $this->connect_db->error;
			echo '");</script> ';
		} else {
			//los ceros son tipo usuario estandar y estado de usuario
			$qInsert = "INSERT INTO users VALUES('$this->user', '$this->password', 0, 0)";
			$execute = mysqli_query($this->connect_db,$qInsert);
			if (!$execute) {
				echo '<script>alert("Error al insertar Usuarios")</script>';
			} else {
				echo '<script>alert("Usuario registrado con éxito")</script>';
				}
			}
	}

	//Función al actualizar datos de un usuario
	function update_user(){
		$this->name=		$_POST['name'];
		$this->lastname =	$_POST['lastname'];
		$this->phone = 		$_POST['phone'];
		$this->email = 		$_POST['email'];
		$sql = "UPDATE person SET name = '$this->name', last_name = '$this->lastname', phone = '$this->phone', email = '$this->email' WHERE user = '$this->user' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar Usuario: ". $this->connect_db->error . "  " . $sql;
		} else {
			echo '<script>alert("Datos Actualizados exitosamente")</script> ';
		}
	}
}
?>