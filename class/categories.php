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
	//Función que retorna arreglo de categorias para uso de input tipo select
	function select($supercategory)
	{	
		//si se ingresa una supercategoria realiza una discriminación de quien la tenga
		if ($supercategory <> '') {
			$where = " WHERE state <> 0 and id_supercategory = $supercategory ";
		} else { $where = "WHERE state <> 0 "; }
		//Consulta de categorias simples
		$sql=("SELECT * FROM categories 
			$where ORDER BY id_supercategory ASC ");
		$cont = 0;
		$category = array(); 
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			while($categoria = $qSelect->fetch_object()){
            $category['id='.$cont] = $categoria->id;
            $category['description='.$cont] = $categoria->description;
            $cont++;
          }
		} 
		return $category;
	}

	//Funcion retorna arreglo de categorias para ser usado en el admin de categorias
	function category_table(){
		$sql=("SELECT cat.id id_cat, sup.description categories, cat.description subcategories, cat.state, sup.id id_subc
			FROM categories cat
			 LEFT JOIN categories sup
			 ON sup.id = cat.id_supercategory
			 ORDER BY sup.id ASC");
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		$categories = array();
		while($array = $qSelect->fetch_object()){
			$categories['id_cat='.$cont] = $array->id_cat;
            $categories['categories='.$cont] = $array->categories;
            $categories['subcategories='.$cont] = $array->subcategories;
            $categories['state='.$cont] = $array->state;
            $categories['id_subc='.$cont] = $array->id_subc;
            $cont++;
		}
		return $categories;
	}

	//Función que inserta una categoria desde el formulario
	function insert_category(){
		$this->description 	= $_POST['description'];
		$this->supercategory= $_POST['supercategory'];
		$this->state     	= isset($_POST['state']) ? $_POST['state'] : "";
		if ($this->state == true) {//depende del estado del input asigna un valor
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

	//Función que actualiza la info de una categoria
	function update_category($id){
		$this->description 	= $_POST['description'];
		$this->supercategory= $_POST['supercategory'];
		$this->state     	= isset($_POST['state']) ? $_POST['state'] : "";
		$this->id			= $id;
		if ($this->state == true) {//depende del estado de input check asigna valor
			$this->state = 1;
		} else { $this->state = 0; }
		//0=inactivo, 1=activo
		$sql = "UPDATE categories SET description = '$this->description', id_supercategory = '$this->supercategory', state = '$this->state' WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar categoria: ". $this->connect_db->error . "  " . $sql;
		}
	}

	//Borra la categoria que reciba su id por parametro
	function delete_category($id){
		$this->id = $id;
		$sql = "DELETE FROM categories WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {//Validación en caso de presentar error.
			echo '<script>alert("No se puede eliminar esta categoria por que tiene productos asignados")</script> ';
		}
	}
}
?>