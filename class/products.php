<?php	
require("connect_db.php");

class products
{
	private $id;
	private $sku;
	private $description;
	private $price;
	private $in_stock;
	private $image_file;
	private $id_category;
	private $connect_db;
	private $nums;
	
	function products()	{
		$this->connect_db 	= $_SESSION['connect'];
	}

	function products_table(){
		$sql=("SELECT prod.sku, prod.description, prod.price, prod.in_stock, prod.image_file, cat.description, prod.id_category, prod.id
			FROM products prod
			 LEFT JOIN categories cat
			 ON prod.id_category = cat.id");
		$qSelect = $this->connect_db->query($sql);
		$this->nums = 0;
		while($array=mysqli_fetch_array($qSelect)){
			echo "<tr class='success'>";
			echo 	"<td><img src='/images/uploads/$array[4]' class='img-rounded' width='100' alt='' /></td>";
			echo 	"<td>$array[0]</td>";
			echo 	"<td>$array[1]</td>";
			echo 	"<td>₡$array[2]</td>";
			echo 	"<td>$array[3]</td>";
			echo 	"<td>$array[5]</td>";
			echo 	"<td><a href='admin_products.php?action=edit&sku=$array[0]&description=$array[1]&price=$array[2]&image=$array[4]&category=$array[5]&id_category=$array[6]&id=$array[7]'><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			echo 	"<td><a href='admin_products.php?action=delete&id=$array[7]&description=$array[1]'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
			echo "</tr>";
			$this->nums++;
		}
		if ($this->nums == 0) {
			echo "<tr><td colspan='8'>No hay productos registrados</td></tr>";
		}
	}

	function validate_image($nombre_img){
	if ($nombre_img <> '') {	
		$this->image_file = $nombre_img;
	}
		else {
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

	function generate_sku($id_category, $id)	{
		$sql=("SELECT description FROM categories WHERE id = '$id_category'");
		$execute=mysqli_query($this->connect_db, $sql);
		if ($category = mysqli_fetch_assoc($execute) ) {
			$str_Category = $category['description'];
			
			if ($id > 0) {
				$this->nums = $id;
			} else	{
				$execute=mysqli_query($this->connect_db,"select max(id) as id from products");
				if ($products = mysqli_fetch_assoc($execute)) {
					$this->nums	= $products['id'] + 1;
				}
			}
		} else{
			$str_Category = 'Cate';
		}
		$str_Category = substr($str_Category, 0, 4);
		//$nums = $this->nums + 1;		 
		$this->sku = 'SKU-' . strtoupper($str_Category) . '-' . $this->nums;
	} 

	function insert_product(){
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->id_category  = $_POST['id_category'];
		if ($this->sku == '') {
			$this->generate_sku($this->id_category, '');
		}
		$qInsert = "INSERT INTO products VALUES('', '$this->sku', '$this->description', '$this->price', 0, '$this->image_file', $this->id_category)";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar producto: ". $this->connect_db->error .   "  " . $qInsert;
		} 
	}

	function update_product($id){
		$this->id 			= $id;
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->id_category  = $_POST['id_category'];
		if ($this->sku == '') {
			$this->generate_sku($this->id_category, $this->id);
		}

		$sql = "UPDATE products SET sku = '$this->sku', description = '$this->description',   price = '$this->price', image_file = '$this->image_file', id_category = '$this->id_category' WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al actualizar producto: ". $this->connect_db->error . "  " . $sql;
		}
	}

	function delete_product($id){
		$this->id = $id;
		$sql = "DELETE FROM products WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {
			echo "Error al eliminar producto: ". $this->connect_db->error . "  " . $sql;
		}
	}
}
?>