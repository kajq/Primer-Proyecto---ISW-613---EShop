<?php 
session_start();
require 'connect_db.php';
/**
 * 
 */
class cronjob_class
{
	private $min_num;
	private $email;
	private $products = array(); 

	//contructor recibe cantidad minima de producto y correo a notificar
	function cronjob_class($pMin_num, $pEmail)
	{
		$this->connect_db 	= $_SESSION['connect'];
		$this->min_num 		= $pMin_num;
		$this->email 		= $pEmail;
	}

	//funcion que discrimina de la base datos los productos que tengan meno o igual valor al minimo indicado, retorna el resultado en un arreglo
	function search_min(){
		$sql = "SELECT * FROM products WHERE in_stock <= '$this->min_num'";
		$cont = 0;
		$qSelect = $this->connect_db->query($sql);
		if ($qSelect <> 'Error') {
			while($product = $qSelect->fetch_object()){
				$this->products['id='.$cont] = $product->id;
	            $this->products['sku='.$cont] = $product->sku;
	            $this->products['description='.$cont] = $product->description;
	            $this->products['in_stock='.$cont] = $product->in_stock;
	            $cont++;
          	} 
          } 
		return $this->products;
	}

	//Función que se encarga de llamar a otra función que envia el correo
	function sendemail(){
		include("sendemail.php");//Llama la funcion para enviar el correo electronico
		$template="email_template.html";//Ruta de la plantilla correo
		$txt_message= $this->low_products();//llama a función que contruye tabla
		$mail_subject="Productos en stock menor a " . $this->min_num;
		
		sendemail($this->email, 'Administrador', $this->email, $txt_message, $mail_subject, $template);//Envia el mensaje
	}

	//Función que contruye una tabla con los productos bajos en stock
	function low_products(){
		$msj = "<h6>Productos con ". $this->min_num ." unidades o menos en stock</h6>
			<table class='table table-hover'>
				<tr class='warning'>
					<td>id</td>
					<td>SKU</td>
					<td>Detalle</td>
					<td>Cantidad</td>
				</tr>";
		for ($i=0; $i < count($this->products)/4; $i++) { 
			$msj = $msj . "<tr>
					<td>" . $this->products['id='.$i] . "</td>
					<td>" . $this->products['sku='.$i] . "</td>
					<td>" . $this->products['description='.$i] . "</td>
					<td>" . $this->products['in_stock='.$i] .	"</td>
					</tr>";
				}
			$msj = $msj . "</table>";
		return $msj;
	}
}
 ?>