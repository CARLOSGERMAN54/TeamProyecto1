<?php

    session_start();
    require_once("../db/connection.php");
	include("../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);

	$sql1 = "SELECT * FROM tb_tipo_mascotas";
	$query = mysqli_query($mysqli, $sql1) or die(mysqli_error());
	//$query = mysqli_fetch_assoc($mascotas);
?>

<?php 
	if((isset($_POST["guardar"])) && ($_POST["guardar"]=="frm_usu"))
    {
		$tip_us = $_POST["tipusu"];
		$sql_usu = "select * from tb_tipo_usuarios where tipo_usuario = '$tip_us'";
		$tip = mysqli_query($mysqli,$sql_usu);
		$row = mysqli_fetch_assoc($tip);

		if($row){
			echo "<script>alert('El tipo usuario ya existe')</script>";
			echo "<script>window.location = 'registroTipoUsuario.php'</script>";
		}elseif($_POST["tipusu"]==""){
			echo "<script>alert('Existen datos vacios')</script>";
			echo "<script>window.location = 'registroTipoUsuario.php'</script>";
		}
        else
        {
            $tipo = $_POST["tipusu"];
            $sql_usu = "insert into tb_tipo_usuarios(tipo_usuario)values('$tipo')";
            $tip = mysqli_query($mysqli,$sql_usu);
            echo "<script>alert('Registro Almacenado Exitosamente')</script>";
			echo "<script>window.location = 'registroTipoUsuario.php'</script>";
        }
	}
?>

<form method="POST">
	<tr>
		<td colspan='2' align="center"><?php echo $usua['nombre_usuario'] .  "(". $usua['tipo_usuario'].")"?></td>
	</tr>
	<tr><br>
	<td colspan='2' align="center">
		<input type="submit" value="Cerrar sesión" name="btncerrar" />
	</td>
		<input type="submit" formaction="menuPrincipal/indexMenu.php" value="Regresar" />
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
<link rel="shortcut icon" href="../../img/HappyPetIcono.png" type="image/x-icon">
<link rel="stylesheet" href="menuPrincipal/estilos.css">
<title>Registro tipo usuario</title>
</head>
<body>
	<section class="title">
		<h1>REGISTRO TIPO DE USUARIO</h1>
	</section>
	<main>
		<table class="formulario" border="1" class="center">
			<form name="frm_usu" method="POST" autocomplete="off">
				   <tr>
				   		<th colspan="2">Crear Tipos de usuario</th>
				   </tr>
				   <tr>
				   		<th>Identificador</th>
						<th><input type="text" readonly/></th>
				   </tr>
				   <tr>
					<th>Tipo usuario</th>
				 		<th><input type="text" name="tipusu" placeholder="Ingresar tipo de usuario"/></th>
				    </tr>
                    <tr>
                        <th colspan="2">&nbsp;</th>
                    </tr>
				<tr>
					<th colspan="2"><input class="boton"type="submit" value="Guardar" name="btn-guardar"></th>
					<input type="hidden" name="guardar" value="frm_usu">
				</tr>
			</form>
		</table>


	</main>
</body>
</html>