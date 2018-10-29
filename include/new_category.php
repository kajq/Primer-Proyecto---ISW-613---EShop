<form  action="../admin_categories.php?action=insert" method="post">
	<label style="font-size: 10pt">
		<b>Descripción</b>	
		<input style="border-radius:15px;" type="text" name="description" required>
		<b>Categoria Padre</b>
		<select name="supercategory" style="border-radius:15px;"> 
			<option value=""></option>
		<?php 
         	$oCategoria->Select();   			
        ?>
        </select>
        <b>Activo</b>
        <input class="form-check-input" type="checkbox" name="state" checked="true">
        <b style='padding-left: 6em'></b>
        <input type="submit" class="btn btn-danger" value="Guardar" >
        <input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_categories.php'">
        
	</label>
</form>