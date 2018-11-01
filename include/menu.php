<?php
/**
 * 
 */
$init = new menu();
$init->show_menu();
class menu
{
	private $connect_db;
	private $rol;

	function menu()
	{
		$this->connect_db	= $_SESSION['connect'];
		$this->rol = isset($_SESSION['rol'])? $_SESSION['rol'] : null ;
	}

	function show_menu()
	{
		if ($this->rol == null) {
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
						<li><a href='login.php'>Iniciar Sesión</a></li>			 
					</ul>
				</div>";
			echo "<div class= 'navbar'>
					<ul class= 'nav pull-right'>
						<li><a href='register.php'>Registrarme</a></li>
					</ul>
				</div>";
		} else {
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
					 	<li><a href='../class/sign_off.php'>Cerrar Sesión</a></li>		 
					</ul>
				  </div>";
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
						<li><a href='profile.php'>Perfil Usuario</a></li>		 
					</ul>
				  </div>";
			echo "<div class='navbar'>
					<ul class='nav pull-right'>
					 	<li><a href='shopping_car.php'>Lista de deseos</a></li>		 
					</ul>
				  </div>";	  	    	
			if ($this->rol == '1') {
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='admins.php'>Administradores</a></li>		 
						</ul>
					  </div>";
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='admin_products.php'>Productos</a></li>		 
						</ul>
					  </div>";	  	  
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='admin_categories.php'>Categorias</a></li>		 
						</ul>
					  </div>";
				echo "<div class='navbar'>
						<ul class='nav pull-right'>
							<li><a href='Index.php'>Inicio</a></li>		 
						</ul>
					  </div>";	  	  
			}	  
		}
	}
}
?>