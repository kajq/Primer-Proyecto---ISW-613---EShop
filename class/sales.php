<?php 
require("connect_db.php");
$oPrueba = new sales('kldc');
$oPrueba->check_cart();
/**
 * 
 */
class sales 
{
	//Declaro variables
	private $id_sale;
	private $user;
	private $sale_date;
	private $state;
	//contructor
	function sales($pUser)
	{
		$this->connect_db 	= $_SESSION['connect'];
		$this->user 		= $pUser;
	}

	function check_cart(){
		//se consulta si hay compras de este usuario en espera
		$sql = "SELECT * FROM sales WHERE user = '$this->user' AND state = 0";
		$sale = array();
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			$qSale = $qSelect->fetch_object();
			if ($qSale == null) {
				//Si no existen vamos a insertar una venta pendiente
				$sql = "INSERT INTO `sales` (`id_sale`, `user`, `sale_date`, `state`) VALUES (NULL, '$this->user', now(), '0')";
				$execute = mysqli_query($this->connect_db,$sql);
				//validación de error en bd
				if (!$execute) {
					echo "Error al insertar producto: ". $this->connect_db->error .   "  " . $sql;
				} else {
					echo "Venta registrada";
				} 
			} else {
				echo "//Si arreglo tiene datos vamos a agregar productos a esta venta";
			}	
		} 
	}


}

 ?>