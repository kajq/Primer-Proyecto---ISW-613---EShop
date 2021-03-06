<?php 		
/**
 * 
 */
class sales 
{
	//Declaro variables
	private $id_sale;
	private $user;
	private $sku;
	private $description;
	private $price;
	private $in_stock;
	//contructor
	function sales()
	{
		require("connect_db.php");
		$this->connect_db 	= $_SESSION['connect'];
		$this->user 		= $_SESSION['username'];
	}

	//Función que retorna los productos de la venta
	function products_cart($id_sale){
		$sql = "SELECT sp.*, p.in_stock, (sp.price * sp.sum) total 
		FROM sold_products sp
		LEFT JOIN products p
		ON sp.sku_product = p.sku
		WHERE id_sale = '$id_sale'";
		$cont = 0;
		$products = array(); 
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			while($product = $qSelect->fetch_object()){
			$products['id='.$cont] = $product->id;
            $products['sku='.$cont] = $product->sku_product;
            $products['description='.$cont] = $product->description;
            $products['price='.$cont] = $product->price;
            $products['sum='.$cont] = $product->sum;
            $products['in_stock='.$cont] = $product->in_stock;
            $products['total='.$cont] = $product->total;
            $cont++;
          	} 
          }
        return $products;  
	}

	//Función que retorna la información de la cabecera del carrito
	function customer(){
		$sql = "SELECT *, curdate() date FROM person WHERE user = '$this->user'";
		$customer = array();
		$qSelect = mysqli_query($this->connect_db, $sql);
		if ($qSelect <> 'Error') { //valida error
			if($qSale = mysqli_fetch_assoc($qSelect)){
				$customer = $qSale;
			}
		}
		return $customer; 
	}

	//funcion de validación para el carrito,
	function check_cart(){
		//se consulta si hay compras de este usuario en espera (carrito)
		$cart = $this->cart('');
		if ($cart <> null) { 
			//si existe actualiza la fecha
			$this->update_cart($cart['id_sale'],0);
		} else {
			//Si no existe inserta un carrito de compras nuevo para el usuario
			$this->add_cart();
			//luego vuelve a consultar para obtener los datos
			$cart = $this->cart('');	
		}
		//se obtienen los valores del producto por post
		$this->sku 			= $_POST['sku'];
		$this->description	= $_POST['description'];
		$this->price 		= $_POST['price'];
		$this->in_stock 	= $_POST['in_stock'];
		$product = $this->product_exist($cart['id_sale'], $this->sku);
		//validación por si no hay del producto en el carrito
		$sum  = isset($product['sum']) ? $product['sum'] : 0;
		//verifica que hayan productos en bodega
		if ($this->in_stock > 0 && $sum < $this->in_stock) {
			if ($product <> null) {
				//si ya hay un producto se suma 1 a la cantidad 
				$new_sum = $product['sum'] + 1;
				$this->change_sum($cart['id_sale'], $this->sku, $new_sum);
			} else {
				//si no existe, se agrega el producto al carrito
				$this->add_product($cart['id_sale']);	
			}
		} else	{//validación cuando detecta que no quedan productos
			echo '<script>alert("Lo sentimos, no quedan '.$this->description.' en bodega")</script> ';
			echo "<script>location.href='../index.php'</script>";	
		}
	}

	//funcion para agregar carrito de compras utilizado en el check_Cart
	function add_cart(){
		$sql = "INSERT INTO `sales` (`id_sale`, `user`, `sale_date`, `state`) VALUES (NULL, '$this->user', now(), '0')";
		$execute = mysqli_query($this->connect_db,$sql);
		//validación de error en bd
		if (!$execute) {//valida error de insert
			echo "Error al insertar carrito: ". $this->connect_db->error .   "  " . $sql;
		}	
	}

	//función que actualiza la fecha del carrito de compras usado en el check_Cart
	function update_cart($id_sale, $state){
		$sql = "UPDATE sales SET sale_date = now(), state = $state
		 WHERE id_sale = '$id_sale'";
		$execute = mysqli_query($this->connect_db, $sql);
		if (!$execute) {//valida error de insert
			echo "Error al actualizar fecha: ". $this->connect_db->error . " " . $sql;
		}
	}

	//Consulta si el producto ya esta agregado al carrito
	function product_exist($id_sale, $sku){
		$sql = "SELECT * FROM sold_products 
		WHERE sku_product = '$sku' AND id_sale = '$id_sale'";
		$product = array();
		$qSelect = mysqli_query($this->connect_db, $sql);
		if ($qSelect <> 'Error') { //valida error
			if($qProduct = mysqli_fetch_assoc($qSelect)){
				$product = $qProduct;
			}
		}
		return $product; 	
	}

	//función que actualiza la cantidad de un producto del carrito de compras
	function change_sum($id_sale, $sku, $new_sum){
		$sql = "UPDATE sold_products SET sum = '$new_sum' WHERE id_sale = '$id_sale' 
		AND sku_product = '$sku'";
		$execute = mysqli_query($this->connect_db, $sql);
		if (!$execute) {//valida error de insert
			echo "Error al actualizar dato: ". $this->connect_db->error . " " . $sql;
		} 
	}

	//función diminuye la cantidad de productos en stock al comprar
	function lower_stock( $sku, $new_sum){
		$sql = "UPDATE products SET in_stock = '$new_sum' WHERE sku = '$sku'";
		$execute = mysqli_query($this->connect_db, $sql);
		if (!$execute) {//valida error de insert
			echo "Error al rebajar producto: ". $this->connect_db->error . " " . $sql;
		} 
	}

	//Se inserta un nuevo producto al carrito
	function add_product($id_sale){
		//Se inserta 1 producto al carrito
		$sql = "INSERT INTO sold_products 
		(id, id_Sale, sku_product, description, price, sum)
		VALUES (NULL, '$id_sale', '$this->sku', '$this->description', '$this->price', 1)"; 
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {//validación de error
			echo "Error al insertar producto: ". $this->connect_db->error . " " . $sql;
		} else {
			echo '<script>alert("Producto agregado a la lista de deseos")</script> ';
			echo "<script>location.href='../shopping_car.php'</script>";
		}
	}

	//obtiene la información del dueño del carrito 
	function cart($id_sale){
		$where = "state = 0";
		if ($id_sale <> '') {
			$where = "id_sale = '$id_sale'";
		}
		$sql = "SELECT * FROM sales WHERE user = '$this->user' AND " . $where;
		$qSelect = mysqli_query($this->connect_db, $sql);
		$cart = null;
		if ($qSelect <> 'Error') { //valida error
			$cart = mysqli_fetch_assoc($qSelect);
		}	
		return $cart;
	}

	//Función que borra un producto del carrito
	function drop_product($id){
		$sql = "DELETE FROM sold_products WHERE id = '$id'";
		$execute = mysqli_query($this->connect_db,$sql);
		if (!$execute) {//validación de error
			echo "Error al borrar producto: ". $this->connect_db->error . " " . $sql;
		} else {
			echo '<script>alert("Producto eliminado de la lista de deseos")</script> ';
			echo "<script>location.href='../shopping_car.php'</script>";
		}
	}

	//Función que llama la función de bajar productos a todos los que estan en el carrito
	function to_buy($id_sale, $products){
	for ($i=0; $i < count($products)/7; $i++) { 
		$new_sum = $products['in_stock='.$i] - $products['sum='.$i];
		$this->lower_stock($products['sku='.$i], $new_sum);
	}//finalmente actualiza el estado a 1, que siginica vendido
	$this->update_cart($id_sale, 1);
	echo '<script>alert("Compra completada con exito!")</script> ';
	echo "<script>location.href='../shopping_history.php'</script>";
	}//redirecciona

}

 ?>