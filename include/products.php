<hr class="soften"/>
<div class="row" style="text-align:left;">
<?php 
include ("class/categories.php");
include ("class/products.php");
$oCategory = new categories();
$oProduct = new products();
$category = $oCategory->Select('');
for ($i=0; $i < (count($category)/2); $i++) { 
	echo "<h3>Categoria: " . $category["description=".$i] . "</h3>";
	$subcategory = $oCategory->Select($category["id=".$i]);			
	if (count($subcategory) > 0) {		   			
		echo "<h4>Subcategorias</h3>";
		for ($j=0; $j < (count($subcategory)/2); $j++) { 
			echo "<div class='span2'>";
			echo 	"<div class='well well-small'>";
			echo 		"<h5>" . $subcategory['description='.$j] . "</h5>";
			echo 		"<a href='al.php'><small>Ver detalles</small></a>";
			echo "</div> </div>";
		}
	
	echo "<br><br><br><br><br><br>";
	}
	$product = $oProduct->Select($category["id=".$i]);
	echo "<div class='row'>";
	for ($k=0; $k < (count($product)/3); $k++) { 
	echo 	"<div class='span6'>";
	echo 		"<div class='thumbnail'>";
	echo		  "<h4 style='text-align:center'>".$product['description='.$k]."</h4>";
	echo		"<img src='../images/uploads/".$product['img='.$k]."' width='150'/>";
	echo 			"<div class='caption'>";
	echo				"<h5>" . $product['sku=' . $k] . "</h5>	";
	echo 				"<a class='pull-right' href='al.php'>Ver detalles</a> <br/>";
	
	echo 	"</div></div></div>";
	} if (count($product) == 0) {
		echo "<div class='span6'> <h4 style='text-align:center'> No hay productos de esta categoria</h4>";
	}
	echo "</div> <br>";
	echo "<hr class='soften'/>";
} 

 ?>