<?php	
/**
 * 
 */
require("connect_db.php");

class categories
{
	private $sku;
	private $description;
	private $price;
	private $in_stock;
	private $image_file;
	private $id_category;
	private $connect_db;
	
	function categories()
	{
		$this->connect_db 	= $_SESSION['connect'];
	}

	function select_categories()
	{
		//Consulta de categorias
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


	function products_table(){
		$sql=("SELECT prod.sku, prod.description, prod.price, prod.in_stock, prod.image_file, cat.description, prod.id_category
			FROM products prod
			 LEFT JOIN categories cat
			 ON prod.id_category = cat.id");
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		while($array=mysqli_fetch_array($qSelect)){
			echo "<tr class='success'>";
			echo 	"<td>$array[0]</td>";
			echo 	"<td>$array[1]</td>";
			echo 	"<td>$array[2]</td>";
			echo 	"<td>$array[3]</td>";
			echo 	"<td>$array[4]</td>";
			echo 	"<td>$array[5]</td>";
			echo 	"<td><a href='admin_products.php?action=edit&id=$array[0]&description=$array[1]&price=$array[2]&in_stock=$array[3]&image=$array[4]'&id_category=$array[6]><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			echo 	"<td><a href='admin_products.php?action=delete&id=$array[0]&category=$array[2]'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
			echo "</tr>";
			$cont++;
		}
		if ($cont == 0) {
			echo "<tr> <td colspan='8'>No hay productos registrados</td> </tr>";
		}
	}

	function insert_product(){
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->in_stock     = $_POST['in_stock'];
		$this->image_file   = $_POST['image_file'];
		$this->id_category  = $_POST['id_category']);

		$qInsert = "INSERT INTO products VALUES('$this->sku','$this->description', '$this->price', '$this->in_stock', '$this->image_file', $this->id_category)";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar producto: ". $this->connect_db->error;
		} 
	}

	function update_category($id){
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->in_stock     = $_POST['in_stock'];
		$this->image_file   = $_POST['image_file'];
		$this->id_category  = $_POST['id_category']);

		$sql = "UPDATE products SET description = '$this->description',   price = '$this->price', in_stock = '$this->in_stock',   image_file = '$this->image_file', id_category = '$this->id_category' WHERE sku = '$this->sku' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar producto: ". $this->connect_db->error . "  " . $sql;
		}
	}

	function delete_product($sku){
		$this->sku = $sku;
		$sql = "DELETE FROM products WHERE sku = '$this->sku' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al eliminar producto: ". $this->connect_db->error . "  " . $sql;
		}
	}
}
?>