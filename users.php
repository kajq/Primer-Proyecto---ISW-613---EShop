<?php
session_start();

class users{

	private $connect_db;
	private $user;
	private $name;
	private $lastname;
	private $phone;
	private $email;
	private $password;

	function users(){
		$this->connect_db = $_SESSION['connect'];
		$this->user=		$_POST['user'];
		$this->name=		$_POST['name'];
		$this->lastname =	$_POST['lastname'];
		$this->phone = 		$_POST['phone'];
		$this->email = 		$_POST['email'];
	}

	//Función que verifica que el email no exista en la bd
	function check_mail(){
		$qMails = ("SELECT email FROM person WHERE email = '$this->email'");
		$execute=mysqli_query($this->connect_db, $qMails);

		if($exists = mysqli_fetch_assoc($execute)){
			echo '<script>alert("Error: $this->email ya esta asignado a un usuario, verifique sus datos")</script> ';
			echo "<script>location.href='register.php'</script>";
			$exists = true;
		} else {
			$exists = false;
		}

		return $exists;
	}

	//Función que genera una contraseña aleatoreamente
	function get_pass(){
		for ($i=0; $i < 12; $i++) { 
			$this->password = $this->password . chr(rand(65,90);
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
		echo "<script>location.href='index.php'</script>";
	}

	//funcion que inserta en la tabla user y person
	function insert_user(){
		$qInsert = "INSERT INTO person VALUES('$this->user','$this->name', '$this->lastname', 
		'$this->lastname', '$this->email')"
		$execute = mysqli_query($this->connect_db,$qInsert);

		if (!$execute) {
			echo ' <script language="javascript">alert("Error al insertar datos personales: ';
			echo $this->connect_db->error;
			echo '");</script> ';
		} else {
			get_pass();
			$qInsert = "INSERT INTO users VALUES('$this->user', '$this->password', 0, 0)";
			$execute = mysqli_query($mysqli,$qInsert);
			if (!$execute) {
				echo '<script>alert("Errormessage1: " . $mysqli->error)';
			} else {
				echo ' <script>alert("Usuario  $this->user registrado con éxito")</script>';
				function sendemail();	
				}
			}
	}

}
?>