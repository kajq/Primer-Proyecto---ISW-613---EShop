<form  action="../admin_categories.php?action=insert" method="post">
	<label style="font-size: 10pt">
		<b>Descripción</b>	
		<input style="border-radius:15px;" type="text" name="description" required value="<?php echo $category?>">
		<b>Categoria Padre</b>
		<select name="supercategory" style="border-radius:15px;"> 
			<option value="<?php echo $id_superc?>"><?php echo $superc?></option>
		<?php 
         	$oCategoria->Select();   			
        ?>
        </select>
        <b>Activo</b>
        <input class="form-check-input" type="checkbox" name="state" 
        <?php echo $check_state ?>>
        <b style='padding-left: 6em'></b>
        <input type="submit" class="btn btn-danger" value="Guardar" >
        <input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_categories.php'">
        
	</label>
</form>