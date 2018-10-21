<?php
require("connect_db.php");
class users{

	private $connect_db;
	public $Accion;
	private $user;
	private $name;
	private $lastname;
	private $phone;
	private $email;
	private $password;
	public $email_exist;

//Constructor valida si se esta registrando o editando un usurio y carga las variables
	function users(){
		$this->connect_db = $_SESSION['connect'];
		if (@!$_SESSION['user']) {
		    $this->Accion=    "Registrar";
		    $this->user=		"";
			$this->name=		"";
			$this->lastname =	"";
			$this->phone = 		"";
			$this->email = 		"";
		} else {
		    $this->Accion=    "Editar";
		    $this->user =     $_SESSION['user'];
		    $this->name =     $_SESSION['name'];
		    $this->lastname = $_SESSION['lastname'];
		    $this->phone =    $_SESSION['phone'];
		    $this->email =    $_SESSION['email'];
		}
	}

	//Función que verifica que el email no exista en la bd
	function check_mail(){
		$qMails  = ("SELECT email FROM person WHERE email = '$this->email'");
		$execute = mysqli_query($this->connect_db, $qMails);

		if($exists = mysqli_fetch_assoc($execute)){
			echo '<script>alert("Error: Correo ya esta asignado a un usuario, verifique sus datos")</script> ';
			echo "<script>location.href='register.php'</script>";
			$this->email_exist = true;
		} else {
			$this->email_exist = false;
		}
	}

	//Función que genera una contraseña aleatoreamente
	function get_pass(){
		for ($i=0; $i < 12; $i++) { 
			$this->password = $this->password . chr(rand(65,90));
		}
	}

	//función que llama otra función que envia un correo de confirmación con la contraseña
	function sendemail(){
		include("sendemail.php");//Llama la funcion para enviar el correo electronico
		$template="email_template.html";//Ruta de la plantilla correo
		$txt_message="Se ha creado exitosamente su usuario en el sistema TaskManager, su administrador de tareas. Para ingresar debes utilizar la contraseña temporal: [ $this->password ]. 
		Ingresa al sistema y cambiar la contraseña para terminar el registro.";
		$mail_subject="Registro exitoso";
		
		sendemail($this->email, $this->name, $this->email, $txt_message, $mail_subject, 
		$template);//Enviar el mensaje
		//echo "<script>location.href='index.php'</script>";
	}

	//funcion que inserta en la tabla user y person
	function insert_user(){
		//se capturan los parametros del post
	   	$this->user=		$_POST['user'];
		$this->name=		$_POST['name'];
		$this->lastname =	$_POST['lastname'];
		$this->phone = 		$_POST['phone'];
		$this->email = 		$_POST['email'];

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
				echo '<script>alert("Errormessage1: "';
				echo $this->connect_db->error . "')</script>";
			} else {
				echo '<script>alert("Usuario registrado con éxito")</script>';
				}
			}
	}
}
?>