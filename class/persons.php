<?php 	
require("connect_db.php");
/**
 * 	
 */
class persons
{
	
	function persons()
	{
		$this->connect_db 	= $_SESSION['connect'];
	}

	//Select que retorna la información de todos los usuarios, se usa en el admin de users
	function select(){
		$sql=("SELECT p.*, case when u.state = 0 then 'Inactivo' else 'Activo' end state, u.rol, case when u.rol = 0 then 'Estandar' else 'Admin' end drol from person p
			    LEFT JOIN users u
			   	ON u.user = p.user
			   	ORDER BY u.rol");
		$cont = 0;
		$users = array(); 
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			while($user = $qSelect->fetch_object()){
				$users['user='.$cont] = $user->user;
				$users['name='.$cont] = $user->name;
				$users['last_name='.$cont] = $user->last_name;
				$users['phone='.$cont] = $user->phone;
				$users['email='.$cont] = $user->email;
				$users['state='.$cont] = $user->state;
				$users['rol='.$cont] = $user->rol;
				$users['drol='.$cont] = $user->drol;
	            
	            $cont++;
          	} 
          } 
		return $users;
	}

	//función que intercambia el rol de un usuario para hacerlo admin o estandar
	function change_rol($user, $rol){
		if ($rol == 0) { $rol = 1;} else { $rol = 0;}
		$sql = "UPDATE users SET rol = '$rol' WHERE user = '$user' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) { //si hay algun error imprime
			echo "Error al actualizar Usuario: ". $this->connect_db->error . "  " . $sql;
		} else {
			echo "<script>location.href='../admin_persons.php'</script>";	
		}
	}
}
?>