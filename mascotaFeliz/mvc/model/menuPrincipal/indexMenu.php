<?php

    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
?>
<form method="POST" class="formulario">
	<div class= "boton-usuario">
		<?php echo $usua['nombre_usuario']?>
	</div>
	<div >
		<input class="boton-sesion" type="submit" value="Cerrar sesión" name="btncerrar" />
	</div>
</form>
<div class= "contenedor-logo">
	
</div>
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
			<title>Menu ADMINISTRADOR</title>
		</head>
		<body>
			<section class="title">
				<h1><?php echo $usua['tipo_usuario']?></h1>
			</section>
			<nav class="navegacion">
				<ul class="menu wrapper" >
					<!--menu registro de mascotas accesible por un propietario y un veterinario ROLES-->
					<!--id_tipo_usuario =(1) administrador-->
					<!--id_tipo_usuario =(2) Veterinario o funcionario-->
					<!--id_tipo_usuario =(3) propietario-->
			<?php if($usua['id_tipo_usuario'] ==1)
			{ 
					?>
					<li>
						<a href="#">
							<img src="img/listadoUsuarios.png" onclick="window.location.href='../listaUsuarios.php'" alt="" class="imagen">
							<span class="text-item">LISTADO USUARIOS</span>
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
							<img src="img/registroMedicamento1.png" onclick="window.location.href='../registroMedicamento.php'" alt="" class="imagen">
							<span class="text-item">REGISTRO MEDICAMENTO</span>
							<span class="down-item"></span>
						</a>
					</li>
				<?php
		     }
			 ?>
			 			<?php if($usua['id_tipo_usuario'] ==1 || $usua['id_tipo_usuario'] ==2)
			{ 
					?>
					<li>
						<a href="#">
							<img src="img/listadoMedicamentos1.png" onclick="window.location.href='../listadoMedicamentos.php'" alt="" class="imagen">
							<span class="text-item">LISTADO MEDICAMENTOS</span>
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
					<img src="img/implementar.jpg" onclick="window.location.href='../registroVisita.php'" alt="" class="imagen">
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

			<?php if($usua['id_tipo_usuario'] == 2)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/registroMascota1.png" onclick="window.location.href='../registroMascota.php'" alt="" class="imagen">
					<span class="text-item">Formular Medicamentos</span>
					<span class="down-item"></span>
				</a>
			</li>
			<?php
		     }
			 ?>

		<?php if($usua['id_tipo_usuario'] == 3)
			{ 
			?>
			<li>
				<a href="#">
					<img src="img/registroMascota4.png" onclick="window.location.href='../registroMascota.php'" alt="" class="imagen">
					<span class="text-item">Consultar Mascotas</span>
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