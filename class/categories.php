<?php	
/**
 * 
 */
require("connect_db.php");

class categories
{
	private $id;
	private $description;
	private $supercategory;
	private $state;
	private $connect_db;
	
	function categories()
	{
		$this->connect_db 	= $_SESSION['connect'];
	}

	function select()
	{
		//Consulta de categorias simples
		$sql=("SELECT * FROM categories WHERE state <> 0");
		$cont = 0;
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			while($categoria = $qSelect->fetch_object()){
            echo '<option value=' . $categoria->id . '> ' .
             $categoria->description . '</option>';
            $cont++; 
          }
		} 
		if ($cont == 0){
			echo '<option value="">No hay categorias disponibles</option>';
		} 
	}


	function category_table(){
		$sql=("SELECT cat.id, sup.description, cat.description, cat.state, sup.id 
			FROM categories cat
			 LEFT JOIN categories sup
			 ON sup.id = cat.id_supercategory");
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		while($array=mysqli_fetch_array($qSelect)){
			echo "<tr class='success'>";
			echo 	"<td>$array[1]</td>";
			echo 	"<td>$array[2]</td>";
			echo 	"<td>$array[3]</td>";
			echo 	"<td><a href='admin_categories.php?action=edit&id=$array[0]&superc=$array[1]&category=$array[2]&state=$array[3]&id_superc=$array[4]'><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			echo 	"<td><a href='admin_categories.php?action=delete&id=$array[0]'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
			echo "</tr>";
			$cont++;
		}
		if ($cont == 0) {
			echo "<tr> <td colspan='5'>No hay categorias registradas</td> </tr>";
		}
	}

	function insert_category(){
		$this->description 	= $_POST['description'];
		$this->supercategory= $_POST['supercategory'];
		$this->state     	= isset($_POST['state']) ? $_POST['state'] : "";
		if ($this->state == true) {
			$this->state = 1;
		} else { $this->state = 0; }
		//0=inactivo, 1=activo, 2=Supercategoria
		//inicia en estado 2 ya que al ser nuevol no tiene subcategorias
		$qInsert = "INSERT INTO categories VALUES('','$this->description', '$this->supercategory', '$this->state')";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar categoria: ". $this->connect_db->error;
		} else {
			if ($this->supercategory > 0) {
				//update del estado de la categoria a supercategoria
				$sql="UPDATE categories SET state = 2 WHERE id = '$this->supercategory'";
				mysqli_query($this->connect_db,$sql);
			}
		}
	}

	function update_category($id){
		$this->description 	= $_POST['description'];
		$this->supercategory= $_POST['supercategory'];
		$this->state     	= isset($_POST['state']) ? $_POST['state'] : "";
		$this->id			= $id;
		if ($this->state == true) {
			$this->state = 1;
		} else { $this->state = 0; }
		//0=inactivo, 1=activo, 2=Supercategoria
		$sql="UPDATE categories SET description = '$this->description', id_supercategory = '$this->supercategory', state = '$this->state' WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar categoria: ". $this->connect_db->error . "  " . $sql;
		}
	}
}
			/*
			
			extract($_GET);
			if(@$id_boton==1){
				if(@$rol=='Usuario'){	
					$sqlUpdateDatos="UPDATE usuarios SET rol = 1 WHERE usuarios.correo = '$id'";
					$resUpdateDatos=mysqli_query($mysqli,$sqlUpdateDatos);
				}
				if(@$rol=='Administrador'){
					$sqlUpdateDatos="UPDATE usuarios SET rol = 2 WHERE usuarios.correo = '$id'";
					$resUpdateDatos=mysqli_query($mysqli,$sqlUpdateDatos);
				}
				if (!$resUpdateDatos) {
					printf("Errormessage1: %s\n", $mysqli->error);
				} else {
					echo '<script>alert("Se ha editado los administradores")</script> ';
					echo "<script>location.href='admin.php'</script>";
				}
			}
			if(@$id_boton==2){
				$sqlborrarDatos="DELETE FROM datos_personales WHERE FK_correo='$id'";
				$resborrarDatos=mysqli_query($mysqli,$sqlborrarDatos);
				if (!$resborrarDatos) {
					echo '<script>alert("No se puede eliminar este registro. Verifique si el usuario tiene tareas")</script> ';
				}else {
					$sqlborrarUsuario="DELETE FROM usuarios WHERE correo='$id'";
					$resborrarUsuario=mysqli_query($mysqli,$sqlborrarUsuario);
					if (!$resborrarUsuario) {
						echo '<script>alert("No se puede eliminar este registro. Verifique si el usuario tiene tareas. Error: $mysqli->error")</script> ';
					} else {
						echo '<script>alert("Usuario ELIMINADO")</script> ';
						echo "<script>location.href='admin.php'</script>";
					}
				}
			}*/
?>