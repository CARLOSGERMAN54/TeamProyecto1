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
	if((isset($_POST["guardar"])) && ($_POST["guardar"]=="frm_med"))
    {
		$tip_us = $_POST["regmed"];
		$sql_med = "select * from tb_medicamentos where medicamentos = '$tip_us'";
		$tip = mysqli_query($mysqli,$sql_med);
		$row = mysqli_fetch_assoc($tip);

		if($row){
			echo "<script>alert('El tipo de medicamento ya existe')</script>";
			echo "<script>window.location = 'registroMedicamento.php'</script>";
		}elseif($_POST["regmed"]==""){
			echo "<script>alert('Existen datos vacios')</script>";
			echo "<script>window.location = 'registroMedicamento.php'</script>";
		}
        else
        {
            $tipo = $_POST["regmed"];
            $sql_med = "insert into tb_mendicamentos(tipo_usuario)values('$tipo')";
            $tip = mysqli_query($mysqli,$sql_med);
            echo "<script>alert('Registro Almacenado Exitosamente')</script>";
			echo "<script>window.location = 'registroMecidamento.php'</script>";
        }
	}
?>

<form class="formulario" method="POST">
	<div class="boton-usuario">
		<?php echo $usua['nombre_usuario'] .  "(". $usua['tipo_usuario'].")"?>
	</div>
	<div>
		<input class="boton-sesion" type="submit" value="Cerrar sesión" name="btncerrar" />
	</div>
	<div>
		<input class="boton-sesion" type="submit" formaction="menuPrincipal/indexMenu.php" value="Regresar" />
	</div>
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
<title>Registro Medicamentos</title>
</head>
<body>
	<section class="title">
		<h1>REGISTRO MEDICAMENTOS</h1>
	</section>
	<main>
		<table border="1" class="center">
			<form name="frm_med" method="POST" autocomplete="off">
				   <tr>
				   		<th colspan="2">Crear medicamentos</th>
				   </tr>
				   <tr>
				   		<th>Identificador</th>
						<th><input type="text" readonly/></th>
				   </tr>
				   <tr>
					<th>Medicamento</th>
				 		<th><input type="text" name="regmed" placeholder="Ingresar tipo de usuario"/></th>
				    </tr>
                    <tr>
                        <th colspan="2">&nbsp;</th>
                    </tr>
				<tr>
					<th colspan="2"><input type="submit" value="Guardar" name="btn-guardar"></th>
					<input type="hidden" name="guardar" value="frm_med">
				</tr>
			</form>
		</table>


	</main>
</body>
</html>