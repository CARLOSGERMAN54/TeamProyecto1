<?php

    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
?>
<form method="POST">
	<tr>
		<td colspan='2' align="center"><?php echo $usua['nombre_usuario']?></td>
	</tr>
	<tr><br>
	<td colspan='2' align="center">
		<input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
		<input type="submit" formaction="../index.php" value="Regresar" />
	</tr>
</form>
<?php 
if(isset($_POST['btncerrar']))
{
	session_destroy();
	header('location: ../../index.html');
}
?>
</div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css">
<title>taller</title>
</head>
<body>
	<section class="title">
		<h1>INTERFAZ    <?php echo $usua['tipo_usuario']?></h1>
	</section>
	<nav class="navegacion">
		<ul class="menu wrapper" >
			<!--menu registro de mascotas accesible por un propietario y un veterinario-->
			<?php if($usua['id_tipo_usuario'] ==2)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/analisis.png" onclick="window.location.href='../registroMascota.php'" alt="" class="imagen">
					<span class="text-item">Registro Mascotas</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
		   <?php if($usua['id_tipo_usuario'] ==2)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/ejecucion.png" alt="" class="imagen">
					<span class="text-item">Listado Mascotas</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
			<?php if($usua['id_tipo_usuario'] ==2)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/implementar.jpg" alt="" class="imagen">
					<span class="text-item">Gestion de Visitas</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
			<li>
				<a href="#">
					<img src="img/planear.png" alt="" class="imagen">
					<span class="text-item">OPCION 4</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li>
				<a href="#">
					<img src="" alt="" class="imagen">
					<span class="text-item">OPCION 5</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li class="first-item">
				<a href="#">
					<img src="img/analisis.png" alt="" class="imagen">
					<span class="text-item">OPCION 6</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li>
				<a href="#">
					<img src="" alt="" class="imagen">
					<span class="text-item">OPCION 7</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li>
				<a href="#">
					<img src="" alt="" class="imagen">
					<span class="text-item">OPCION 8</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li>
				<a href="#">
					<img src="" alt="" class="imagen">
					<span class="text-item">OPCION 9</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li>
				<a href="#">
					<img src="" alt="" class="imagen">
					<span class="text-item">OPCION 10</span>
					<span class="down-item"></span>
				</a>
			</li>

			<li>
				<a href="#">
					<img src="" alt="" class="imagen">
					<span class="text-item">OPCION 11</span>
					<span class="down-item"></span>
				</a>
			</li>
			
		</ul>
		
	</nav>
</body>
</html>