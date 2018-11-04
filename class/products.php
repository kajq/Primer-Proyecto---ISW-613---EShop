<?php	
/**
 * 
 */
require("connect_db.php");

class products
{
	private $sku;
	private $description;
	private $price;
	private $in_stock;
	private $image_file;
	private $id_category;
	private $connect_db;
	
	function products()
	{
		$this->connect_db 	= $_SESSION['connect'];
	}

	/*function select_categories()
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
	}*/


	function products_table(){
		$sql=("SELECT prod.sku, prod.description, prod.price, prod.in_stock, prod.image_file, cat.description, prod.id_category
			FROM products prod
			 LEFT JOIN categories cat
			 ON prod.id_category = cat.id");
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		while($array=mysqli_fetch_array($qSelect)){
			echo "<tr class='success'>";
			echo 	"<td><img src='/images/uploads/$array[4]' class='img-rounded' width='100' alt='' /></td>";
			echo 	"<td>$array[0]</td>";
			echo 	"<td>$array[1]</td>";
			echo 	"<td>₡$array[2]</td>";
			echo 	"<td>$array[3]</td>";
			echo 	"<td>$array[5]</td>";
			echo 	"<td><a href='admin_products.php?action=edit&sku=$array[0]&description=$array[1]&price=$array[2]&image=$array[4]&category=$array[5]&id_category=$array[6]'><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			echo 	"<td><a href='admin_products.php?action=delete&sku=$array[0]&description=$array[1]'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
			echo "</tr>";
			$cont++;
		}
		if ($cont == 0) {
			echo "<tr> <td colspan='8'>No hay productos registrados</td> </tr>";
		}
	}

	function validate_image($nombre_img){
	if ($nombre_img <> '') {	
		echo "se usa imagen aterior" . $nombre_img;
			$this->image_file = $nombre_img;
	}
		else {
			echo "se selecciono imagen". $nombre_img;	
		// Recibo los datos de la imagen
		$nombre_img = $_FILES['imagen']['name'];
		$tipo = $_FILES['imagen']['type'];
		$tamano = $_FILES['imagen']['size'];
		 
		//Si existe imagen y tiene un tamaño correcto
		if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 200000)) 
		{
		   //indicamos los formatos que permitimos subir a nuestro servidor
		   if (($_FILES["imagen"]["type"] == "image/gif")
		   || ($_FILES["imagen"]["type"] == "image/jpeg")
		   || ($_FILES["imagen"]["type"] == "image/jpg")
		   || ($_FILES["imagen"]["type"] == "image/png"))
		   {
		      // Ruta donde se guardarán las imágenes que subamos
		      $directorio = $_SERVER['DOCUMENT_ROOT'].'/images/uploads/';
		      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
		      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
		      $this->image_file = $nombre_img;
		    } 
		    else 
		    {
		       //si no cumple con el formato
		       echo "No se puede subir una imagen con ese formato ";
		    }
			} 
			else 
			{
			   //si existe la variable pero se pasa del tamaño permitido
			   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
			}
		}
	} 

	function insert_product(){
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->id_category  = $_POST['id_category'];

		$qInsert = "INSERT INTO products VALUES('$this->sku','$this->description', '$this->price', 0, '$this->image_file', $this->id_category)";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar producto: ". $this->connect_db->error .   "  " . $qInsert;
		} 
	}

	function update_product($id){
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->id_category  = $_POST['id_category'];

		$sql = "UPDATE products SET description = '$this->description',   price = '$this->price', image_file = '$this->image_file', id_category = '$this->id_category' WHERE sku = '$this->sku' ";
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