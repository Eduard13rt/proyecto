<?php

function menu(){
	
	if($_SESSION['login']){

		if($_SESSION['tipo_usuario']==1){

			echo "<ul>";
			echo "<li><a href='algo.php'> Usuarios</a></li>
			<li><a href='otro.php'> Reportes
			</a></li>
			<li><a href='calific.php'> Calificaciones</a></li>";
			echo "</ul>";
		} else{
			echo "<li><a href='otro.php'> Mis calificaciones</a></li>
			<li><a href='pefil.php'> Mi perfil</a></li>";

		}
	} else{
	echo "debes <a href='login.php'>loguearte</a>";
	}

}
