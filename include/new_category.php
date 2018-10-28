<form  action="../class/categories.php?action=insert" method="post"  name='new'>
	<label style="font-size: 10pt">
		<b>Descripción</b>	
		<input style="border-radius:15px;" type="text" name="description" required>
		<b>Categoria Padre</b>
		<select name="supercategory" style="border-radius:15px;"> 
			<option value=""></option>
		<?php require("class/categories.php");
         	$Categorias = new categories();
         	$Categorias->Select();   			
        ?>
        </select>	
        <input type="submit" class="btn btn-danger" value="Guardar">
        <input type="submit" class="btn btn-danger" value="Cancelar" onclick = "window.location.href='../admin_categories.php'">
        
	</label>
</form>