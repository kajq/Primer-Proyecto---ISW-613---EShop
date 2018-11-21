<?php  //Formulario de categorias de productos
extract($_GET);
if ($action == 'new') {
	echo "<form  action='../admin_categories.php?action=insert' method='post'>";
}  elseif ($action == 'edit') {
	echo "<form  action='../admin_categories.php?action=update&id=$id' method='post'>";
}
        ?>
	<label style="font-size: 10pt">  
		<b>Descripción</b>	
		<input style="border-radius:15px;" type="text" name="description" required value="<?php echo $category?>">
		<b>Categoria Padre</b>
		<select name="supercategory" style="border-radius:15px;"> 
			<option value="<?php echo $id_superc?>"><?php echo $superc?></option>
			<option value="">Ninguna</option>
		<?php 
         	$category = $oCategoria->Select('');   			
         	for ($i=0; $i < (count($category)/2); $i++) { 
         		echo '<option value=' . $category["id=".$i] . '> ' .
             	$category["description=".$i] . '</option>';
         	}
        ?>
        </select>
        <b>Activo</b>
        <input class="form-check-input" type="checkbox" name="state" 
        <?php echo $check_state ?>>
        <b style='padding-left: 6em'></b>
        <input type='submit' class='btn btn-danger' value='Guardar' >
        <input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_categories.php'">
	</label>
</form>