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
		$sql=("SELECT * FROM categories 
			WHERE state <> 0 ORDER BY id_supercategory ASC ");
		$cont = 0;
		$category = array(); 
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			while($categoria = $qSelect->fetch_object()){
            /*echo '<option value=' . $categoria->id . '> ' .
             $categoria->description . '</option>';*/
            $category['id='.$cont] = $categoria->id;
            $category['description='.$cont] = $categoria->description;
            $cont++;
          }
		} 
		return $category;
	}


	function category_table(){
		$sql=("SELECT cat.id, sup.description, cat.description, cat.state, sup.id 
			FROM categories cat
			 LEFT JOIN categories sup
			 ON sup.id = cat.id_supercategory
			 ORDER BY sup.id ASC");
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		while($array=mysqli_fetch_array($qSelect)){
			echo "<tr class='success'>";
			echo 	"<td>$array[1]</td>";
			echo 	"<td>$array[2]</td>";
			echo 	"<td>$array[3]</td>";
			echo 	"<td><a href='admin_categories.php?action=edit&id=$array[0]&superc=$array[1]&category=$array[2]&state=$array[3]&id_superc=$array[4]'><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			echo 	"<td><a href='admin_categories.php?action=delete&id=$array[0]&category=$array[2]'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
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
		//0=inactivo, 1=activo
		$qInsert = "INSERT INTO categories VALUES('','$this->description', '$this->supercategory', '$this->state')";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar categoria: ". $this->connect_db->error;
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
		$sql = "UPDATE categories SET description = '$this->description', id_supercategory = '$this->supercategory', state = '$this->state' WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar categoria: ". $this->connect_db->error . "  " . $sql;
		}
	}

	function delete_category($id){
		$this->id = $id;
		$sql = "DELETE FROM categories WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar categoria: ". $this->connect_db->error . "  " . $sql;
		}
	}
}
?>