<?php 
/**Clase para uso de consultas de compras realizadas y estadisticas
 * 
 */
class purchases 
{
	private $id_Factura;
	private $Fecha;
	private $Cliente;
	private $Detalles;
	
	//constructor
	function purchases()
	{
		require("connect_db.php");
		$this->connect_db 	= $_SESSION['connect'];
		$this->user 		= $_SESSION['username'];
	}

	function select_purchases(){
		$sql = "SELECT s.id_sale, s.sale_date, p.name, p.last_name, 
				(SELECT SUM(price * sum) total FROM sold_products 
				WHERE id_sale = s.id_sale GROUP by id_sale) total 
				FROM `sales` s 
				 LEFT JOIN person p 
				 ON p.user = s.user 
				WHERE s.state = 1 and s.user = '$this->user'";
		$purchases = array(); 
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		if ($qSelect <> 'Error') {
			while($sale = $qSelect->fetch_object()){
			$purchases['id='.$cont] = $sale->id_sale;
            $purchases['date='.$cont] = $sale->sale_date;
            $purchases['name='.$cont] = $sale->name;
            $purchases['last_name='.$cont] = $sale->last_name;
            $purchases['total='.$cont] = $sale->total;
            $cont++;
          	} 
          }
        return $purchases;  
	}

}
 ?>