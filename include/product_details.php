<?php 
$details = $oProduct->Select('',$id);
 ?>
<div class='row'>
	<div class='span6'>
		<div class='thumbnail'>
			<label style="font-size: 12pt">Imagen del Producto</label>
			<img src="../images/uploads/<?php echo $details['img=0'] ?>" width='250'/>
		</div>
	</div>
	<div class='span6'>
		<div class='thumbnail'>
			<table border="0" align="center" valign="middle">
				<form action="../class/sales.php" method="post">
				<tr>
					<td colspan="2"> 
						<label style="font-size: 14pt">Detalles del Producto</label>
					</td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Código: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="sku" value="<?php echo $details['sku=0'] ?>"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Descripción: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="description" value="<?php echo $details['description=0'] ?>"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Precio: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="price" value="<?php echo $details['price=0'] ?>"></td>
				</tr>
				<tr>
					<td><label style="font-size: 14pt"><b>Existencias: </b></label></td>
					<td><input readonly style="border-radius:15px;" type="text" name="in_stock" value="<?php echo $details['in_stock=0'] ?>"></td>
				</tr>
				<tr>
					<td height="30" align="center" colspan="2">
						<input class="btn btn-danger" type="submit" value="Lo quiero">
					</td>
	          	</tr> 
	          	</form>
			</table>
		</div>
	</div>
</div>
<br>
<hr class='soften'/>";