<hr class="soften"/>
<div class="row" style="text-align:left;">
<?php //include de productos que se muestran en el incio
include ("class/categories.php");
include ("class/products.php");
$oCategory = new categories();
$oProduct = new products();

if ($type == 'prod') {
	include ('product_details.php');
}

$category = $oCategory->Select('');
for ($i=0; $i < (count($category)/2); $i++) { 
	echo "<h3>Categoria: " . $category["description=".$i] . "</h3>";
	$subcategory = $oCategory->Select($category["id=".$i]);			
	if (count($subcategory) > 0) {		   			
		echo "<h4>Subcategorias</h4>";
		for ($j=0; $j < (count($subcategory)/2); $j++) { 
			echo "<div class='span3'>";
			echo 	"<div class='well well-small'>";
			echo 		"<h5>" . $subcategory['description='.$j] . "</h5>";
			echo 		"<a href='Index.php?type=cat&id=".$subcategory['id='.$j]."'><small>Ver detalles</small></a>";
			echo "</div> </div>";
		}
	
	echo "<br><br><br><br><br><br>";
	}
	$product = $oProduct->Select($category["id=".$i],'','');
	echo "<div class='row'>";
	for ($k=0; $k < (count($product)/8); $k++) { 
		//if ($product['in_stock='.$k] > 0) {
			echo 	"<div class='span6'>";
			echo 		"<div class='thumbnail'>";
			echo		  "<h4 style='text-align:center'>".$product['description='.$k]."</h4>";
			echo		"<img src='../images/uploads/".$product['img='.$k]."' width='250'/>";
			echo 			"<div class='caption'>";
			echo 				"<a class='pull-right' href='Index.php?type=prod&sku=" .        $product['sku='.$k] . "' >".$product['sku=' . $k]."</a> <br/>";
			
			echo 	"</div></div></div>";
		//}
	} if (count($product) == 0) {
		echo "<div class='span6'> <h4 style='text-align:center'> No hay productos de esta categoria</h4> </div>";
	}
	echo "</div> <br>";
	echo "<hr class='soften'/>";
} 

 ?>