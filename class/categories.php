<?php	
/**
 * 
 */
require("connect_db.php");
//$oCategoria = new categories();
$action = isset($_GET["action"]) ? $_GET["action"] : "";
    if ($action == 'insert') {
    	$oCategoria->insert_category();
    }  

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
		$sql=("SELECT * from categories where state = 2");
		$cont = 0;
		//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
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
		$sql=("SELECT sup.description, cat.description, cat.state 
			FROM categories cat
			 LEFT JOIN categories sup
			 ON sup.id = cat.id_supercategory");
		$qSelect = $this->connect_db->query($sql);
		while($arreglo=mysqli_fetch_array($qSelect)){
			echo "<tr class='success'>";
			echo 	"<td>$arreglo[0]</td>";
			echo 	"<td>$arreglo[1]</td>";
			echo 	"<td>$arreglo[2]</td>";
			echo 	"<td><a href='categories.php?action=Update'><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			echo 	"<td><a href='categories.php?action=Delete'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
			echo "</tr>";
		}
	}

	function insert_category(){
		$this->description = $_POST['description'];
		$this->supercategory= $_POST['supercategory'];
		$this->state 		= 2;//0=inactivo, 1=activo, 2=Supercategoria
		//inicia en estado 2 ya que al ser nuevol no tiene subcategorias
		$qInsert = "INSERT INTO categories VALUES('','$this->description', '$this->supercategory', '$this->state')";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar categoria: ". $this->connect_db->error;
		} else {
			echo '<script>alert("Categoria "'. $this->description . ' agregada exitosamente)</script> ';
			echo "<script>location.href='../admin_categories.php'</script>";	
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