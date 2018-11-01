<?php  
extract($_GET);
if ($action == 'new') {
	echo "<form  action='../admin_products.php?action=insert' method='post'>";
}  elseif ($action == 'edit') {
	echo "<form  action='../admin_products.php?action=update&sku=$sku' method='post'>";
}
        ?>
	<label style="font-size: 10pt">  
		<b>SKU</b>	
		<input style="border-radius:15px;" type="text" name="sku" required value="<?php echo $sku?>">
		<b>Detalle</b>	
		<input style="border-radius:15px;" type="text" name="description" required value="<?php echo $description?>">
		<b>Precio</b>	
		<input style="border-radius:15px;" type="number" name="price" required value="<?php echo $price?>">
		<br>
		<b>Imagen</b>	
		<input style="border-radius:15px;" type="text" name="image_file" required value="<?php echo $image_file?>">
		<b>Categoría</b>
		<select name="id_category" style="border-radius:15px;"> 
			<option value="<?php echo $id_category?>"><?php echo $category?></option>
			<option value="">Ninguna</option>
		<?php 
         	$oProducto->select_categories();   			
        ?>
        </select>
        <b style='padding-left: 5em'></b>
        <input type='submit' class='btn btn-danger' value='Guardar' >
        <input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_products.php'">
	</label>
</form>