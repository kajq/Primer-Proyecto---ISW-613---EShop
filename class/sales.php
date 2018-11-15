<?php 
session_start();
require("connect_db.php");
if (@!$_SESSION['username']) {
		echo '<script>alert("Debes registrarte para poder comprar")</script> ';
		echo "<script>location.href='../index.php'</script>";	
	}


$oSale = new sales();
$oSale->check_cart();
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
		$this->connect_db 	= $_SESSION['connect'];
		$this->user 		= $_SESSION['username'];
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
			echo "Error al insertar producto: ". $this->connect_db->error .   "  " . $sql;
		} else {
			echo "Producto " . $this->description . " agregada al carrito"; 
		}
	}

	function check_cart(){
		//se consulta si hay compras de este usuario en espera (carrito)
		$sql = "SELECT * FROM sales WHERE user = '$this->user' AND state = 0";
		$qSelect = mysqli_query($this->connect_db, $sql);
		if ($qSelect <> 'Error') { //valida error
			if($qSale = mysqli_fetch_assoc($qSelect)){
				//en caso de que ya exista el carrito se actualiza la fecha
				$this->update_cart($qSale['id_sale']);
				} else {
				//Si no existe inserta un carrito de compras nuevo para el usuario
				$this->add_cart();
				echo "venta agregada";
				$qSelect = mysqli_query($this->connect_db, $sql);
				$qSale = mysqli_fetch_assoc($qSelect);	
				}
		} 
		//se agrega producto
		$this->add_product($qSale['id_sale']);	
	}

}

 ?>