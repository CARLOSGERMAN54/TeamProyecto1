<?php
//inicio session
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
	</tr>
</form>
<?php 
if(isset($_POST['btncerrar']))
{
	session_destroy();
	header('location: ../../login.html');
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
<link rel="shortcut icon" href="../../../img/HappyPetIcono.png" type="image/x-icon">
<link rel="stylesheet" href="estilos.css">
<title>Menu Administrador</title>
</head>
<body>
	<section class="title">
		<h1>INTERFAZ    <?php echo $usua['tipo_usuario']?></h1>
	</section>
	<nav class="navegacion">
		<ul class="menu wrapper" >
			<!--menu registro de mascotas accesible por un propietario y un veterinario ROLES-->
			<!--id_tipo_usuario =(1) administrador-->
			<!--id_tipo_usuario =(2) Veterinario o funcionario-->
			<!--id_tipo_usuario =(3) propietario-->
			<!--id_tipo_usuario =(10) auxiliar-->

			<?php if($usua['id_tipo_usuario'] ==2)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/analisis.png" onclick="window.location.href='../registroMascota.php'" alt="" class="imagen">
					<span class="text-item">REGISTRO MASCOTAS</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
		   <?php if($usua['id_tipo_usuario'] ==2 || $usua['id_tipo_usuario'] ==1)
			{ 
			?>
			<li>
				<a href="#">
				<img src="img/listadoMascota.png" onclick="window.location.href='../listadoMascotas.php'" alt="" class="imagen">
					<span class="text-item">LISTADO DE MASCOTAS</span>
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
					<span class="text-item">HISTORIA CLINICA</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
		   <?php if($usua['id_tipo_usuario'] ==1)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/registroTipoUsuario.png" onclick="window.location.href='../registroTipoUsuario.php'" alt="" class="imagen">
					<span class="text-item">REGISTRO TIPO USUARIOS</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
			<?php if($usua['id_tipo_usuario'] ==1)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/asignarRoles.png" onclick="alert('En construcción')" alt="" class="imagen">
					<span class="text-item">ASIGNAR ROLES</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
			<?php if($usua['id_tipo_usuario'] ==1)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/registroUsuario.png" onclick="window.location.href='../registroUsuario.php'" alt="" class="imagen">
					<span class="text-item">REGISTRO USUARIO</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>

			<?php if($usua['id_tipo_usuario'] ==1 || $usua['id_tipo_usuario'] == 2)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/registroMascota.png" onclick="window.location.href='../registroMascota.php'" alt="" class="imagen">
					<span class="text-item">REGISTRO MASCOTA</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>
		</ul>
		
	</nav>
</body>
</html>