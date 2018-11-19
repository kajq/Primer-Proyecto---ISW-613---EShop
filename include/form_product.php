	<?php  

if ($action == 'new') {
	$product_edit = null;
	echo "<form  action='../admin_products.php?action=insert' method='post' enctype='multipart/form-data' >";
}  elseif ($action == 'edit') {
	$product_edit = $oProducto->select('', $id);
	echo "<form action='../admin_products.php?action=update&id=$id&img=" .             $product_edit['img=0']."' method='post' enctype='multipart/form-data'>";
}
        ?>
		<table >
			<tr>
				<td>
					<b>SKU</b>	
				</td>
				<td>
					<input style="border-radius:15px;" type="text" name="sku" placeholder="Automático SKU-CATE-#" maxlength="15" value="<?php echo $product_edit['sku=0']; ?>">
				</td>
				<td>
					<b>Detalle</b>			
				</td>
				<td>
					<input style="border-radius:15px;" type="text" name="description" required value="<?php echo $product_edit['description=0'] ?>">
				</td>
				<td>
					<b>Precio</b>			
				</td>
				<td>
					<input style="border-radius:15px;" type="number" name="price" required value="<?php echo $product_edit['price=0']; ?>">
				</td>
			</tr>	
			<tr>
				<td>
					<b>Categoría</b>
				</td>
				<td>
					<select name="id_category" style="border-radius:15px;"> 
						<option value="<?php echo $product_edit['id_category=0'];?>"><?php echo $product_edit['category=0'];?></option>
						<option value="">Ninguna</option>
							<?php 
						include ("class/categories.php");
						$oCategoria = new categories();
			         	$category = $oCategoria->Select('');   			
			         	for ($i=0; $i < (count($category)/2); $i++) { 
			         		echo '<option value=' . $category["id=".$i] . '> ' .
			             	$category["description=".$i] . '</option>';
			         	}   			
	        ?>
	        		</select>		
				</td>
				<td>	
					<b>Cantidad</b>	
				</td>
				<td>	
					<input style="border-radius:15px;" type="number" name="in_stock" required value="<?php echo $product_edit['in_stock=0'] ?>">
				</td>
				<td>	
				</td>
				<td>
					<input type='submit' class='btn btn-danger' value='Guardar'>
					<input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_products.php'">	
				</td>
			</tr>
			<tr>
				<td>
					<b>Imagen</b>
				</td>
				<td colspan="6">
					<input id="imagen" name="imagen" size="30" type="file">	
				</td>
			</tr>
		</table>
	<!--</label> -->
</form>