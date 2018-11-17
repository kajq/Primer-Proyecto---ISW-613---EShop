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
	//contructor
	function sales()
	{
		require("connect_db.php");
		$this->connect_db 	= $_SESSION['connect'];
		$this->user 		= $_SESSION['username'];
	}

	//Función que retorna los productos de la venta
	function products_cart($id_sale){
		$sql = "SELECT sp.*, p.in_stock FROM sold_products sp
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

	//funcion para agregar carrito de compras
	function add_cart(){
		$sql = "INSERT INTO `sales` (`id_sale`, `user`, `sale_date`, `state`) VALUES (NULL, '$this->user', now(), '0')";
		$execute = mysqli_query($this->connect_db,$sql);
		//validación de error en bd
		if (!$execute) {//valida error de insert
			echo "Error al insertar carrito: ". $this->connect_db->error .   "  " . $sql;
		}	
	}

	//función que actualiza la fecha del carrito de compras
	function update_cart($id_sale){
		$sql = "UPDATE sales SET sale_date = now() WHERE id_sale = '$id_sale'";
		$execute = mysqli_query($this->connect_db, $sql);
		if (!$execute) {//valida error de insert
			echo "Error al actualizar fecha: ". $this->connect_db->error . " " . $sql;
		} else {
			echo "Fecha carrito actualizada";
		}
	}

	function add_product($id_sale){
		//se obtienen los valores del producto por post
		$this->sku 			= $_POST['sku'];
		$this->description	= $_POST['description'];
		$this->price 		= $_POST['price'];
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

	function cart(){
		$sql = "SELECT * FROM sales WHERE user = '$this->user' AND state = 0";
		$qSelect = mysqli_query($this->connect_db, $sql);
		$cart = null;
		if ($qSelect <> 'Error') { //valida error
			$cart = mysqli_fetch_assoc($qSelect);
		}	
		return $cart;
	}

	function check_cart(){
		//se consulta si hay compras de este usuario en espera (carrito)
		$cart = $this->cart();
		if ($cart <> null) { //si existe
			//actualiza la fecha
			$this->update_cart($cart['id_sale']);
		} else {
			//Si no existe inserta un carrito de compras nuevo para el usuario
			$this->add_cart();
			//luego vuelve a consultar para obtener los datos
			$cart = $this->cart();	
		}
		//se agrega producto
		$this->add_product($cart['id_sale']);		
	}

}

 ?>