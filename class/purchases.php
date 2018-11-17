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
	}

	function select_purchases($user){
		$where = " WHERE s.state = 1 ";
		if ($user <> 'admin') {
			$where = $where . "and s.user = '$user'";
		}
		$sql = "SELECT s.id_sale, s.sale_date, p.name, p.last_name, 
				(SELECT SUM(sum) total FROM sold_products 
				WHERE id_sale = s.id_sale GROUP by id_sale) sum, 
				(SELECT SUM(price * sum) total FROM sold_products 
				WHERE id_sale = s.id_sale GROUP by id_sale) total 
				FROM `sales` s 
				 LEFT JOIN person p 
				 ON p.user = s.user " . $where;
		$purchases = array(); 
		$qSelect = $this->connect_db->query($sql);
		$cont = 0;
		if ($qSelect <> 'Error') {
			while($sale = $qSelect->fetch_object()){
			$purchases['id='.$cont] = $sale->id_sale;
            $purchases['date='.$cont] = $sale->sale_date;
            $purchases['name='.$cont] = $sale->name;
            $purchases['last_name='.$cont] = $sale->last_name;
            $purchases['sum='.$cont] = $sale->sum;
            $purchases['total='.$cont] = $sale->total;
            $cont++;
          	} 
          }
        return $purchases;  
	}

	function total_users(){
		$sql = "SELECT COUNT(user) total FROM users";
		$execute = mysqli_query($this->connect_db, $sql);
		$users = mysqli_fetch_assoc($execute);
		return($users['total']);
	}

	function total_products($user){
		$where = 'WHERE s.state = 1 ';
		if ($user <> 'admin') {
			$where = $where . " AND s.user = '$user'";
		}
		$sql = "SELECT sum(sp.sum) total FROM sold_products sp
				 LEFT JOIN sales s
				 ON s.id_sale = sp.id_sale " . $where ;
		$execute = mysqli_query($this->connect_db, $sql);
		$products = mysqli_fetch_assoc($execute);
		return($products['total']);	
	}

	function total_sales($user){
		$where = "WHERE s.state = 1 ";
		if ($user <> 'admin') {
			$where = $where . " AND s.user = '$user'";
		}
		$sql = "SELECT sum(sp.sum * sp.price) total FROM sold_products sp 
				 LEFT JOIN sales s 
				 ON s.id_sale = sp.id_sale " . $where;
		$execute = mysqli_query($this->connect_db, $sql);
		$sales = mysqli_fetch_assoc($execute);
		return($sales['total']);		
	}

}
 ?>