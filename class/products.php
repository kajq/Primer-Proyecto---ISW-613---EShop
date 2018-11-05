<?php	
require("connect_db.php");

class products
{
	//Declaro variables
	private $id;
	private $sku;
	private $description;
	private $price;
	private $in_stock;
	private $image_file;
	private $id_category;
	private $connect_db;
	private $nums;
	
	//contructor que llama a la conexión de la bd
	function products()	{
		$this->connect_db 	= $_SESSION['connect'];
	}

	//función que consulta los productos y los imprime en una tabla
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
			//Boton de editar
			echo 	"<td><a href='admin_products.php?action=edit&sku=$array[0]&description=$array[1]&price=$array[2]&image=$array[4]&category=$array[5]&id_category=$array[6]&id=$array[7]'><img src='../images/update.jpg' class='img-rounded' width='25'></td>";
			//Boton de borrar
			echo 	"<td><a href='admin_products.php?action=delete&id=$array[7]&description=$array[1]'><img src='../images/delete.png' class='img-rounded' width='25'></td>";
			echo "</tr>";
			$this->nums++;//Contador para detectar cantidad de productos
		}
		if ($this->nums == 0) {//si no hay productos imprime el mensaje
			echo "<tr><td colspan='8'>No hay productos registrados</td></tr>";
		}
	}

	//Función para el input de imagen para producto
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

	//Para validar el formulario
	function validate_form($id_category, $id)	{
		//si el usuario deja sin categoria el formulario
		if ($id_category == '') {
			echo '<script>alert("Debe seleccionar una categoría")</script> ';
			echo "<script>location.href='../admin_products.php'</script>";	
		}
		//si el usuario deja el SKU en blanco en el formulario
		if ($this->sku == '') {
			//se obtiene la descripción de la categoria seleccionada
			$sql=("SELECT description FROM categories WHERE id = '$id_category'");
			$execute=mysqli_query($this->connect_db, $sql);
			if ($category = mysqli_fetch_assoc($execute) ) {
				$str_Category = $category['description'];
				if ($id > 0) {
					//si esta editando, se obtiene el id del registro
					$this->nums = $id;
				} else	{
					//si es nuevo, consulta el id mayor de la bd y le suma 1
					$execute=mysqli_query($this->connect_db,"select max(id) as id from products");
					if ($products = mysqli_fetch_assoc($execute)) {
						$this->nums	= $products['id'] + 1;
					}
				}
			} else{
				//si no logra obtener la categoria define uno por defecto
				$str_Category = 'Cate';
			}
			//se obtiene 4 caracteres en mayuscula de la categoria 
			$str_Category = substr($str_Category, 0, 4);
			//finalmente concatena Prefijo, categoria y número
			$this->sku = 'SKU-' . strtoupper($str_Category) . '-' . $this->nums;
		} else	{
			//en caso de se ingrese sku no hace nada
		}
	} 

	//Agregar nuevo producto
	function insert_product(){
		//se capturan valores del formulario
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->id_category  = $_POST['id_category'];
		//se llama función para validar y procesar formulario
		$this->validate_form($this->id_category, '');
		//Se inserta a la bd
		$qInsert = "INSERT INTO products VALUES('', '$this->sku', '$this->description', '$this->price', 0, '$this->image_file', $this->id_category)";
		$execute = mysqli_query($this->connect_db,$qInsert);
		//validación de error en bd
		if (!$execute) {
			echo "Error al insertar producto: ". $this->connect_db->error .   "  " . $qInsert;
		} 
	}
	//Actualizar producto
	function update_product($id){
		//se captura valores del formulario
		$this->id 			= $id;
		$this->sku 			= $_POST['sku'];
		$this->description 	= $_POST['description'];
		$this->price        = $_POST['price'];
		$this->id_category  = $_POST['id_category'];
		//llama a función que valida el formulario
		$this->validate_form($this->id_category, $this->id);
		//sentencia para actualzar el registro
		$sql = "UPDATE products SET sku = '$this->sku', description = '$this->description',   price = '$this->price', image_file = '$this->image_file', id_category = '$this->id_category' WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) { //si hay algun error imprime
			echo "Error al actualizar producto: ". $this->connect_db->error . "  " . $sql;
		}
	}
	//Elimar producto
	function delete_product($id){
		$this->id = $id;//se captura el id y se ejecuta el borrado de la bd
		$sql = "DELETE FROM products WHERE id = '$this->id' ";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {//si da error
			echo "Error al eliminar producto: ". $this->connect_db->error . "  " . $sql;
		}
	}
}
?>