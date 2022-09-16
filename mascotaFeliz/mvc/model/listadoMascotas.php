<?php

    session_start();
    require_once("../db/connection.php");
	include("../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);

	$sql1 = "SELECT * FROM tb_tipo_mascotas";
	$query = mysqli_query($mysqli, $sql1) or die(mysqli_error());
	$fila = mysqli_fetch_assoc($query);
?>

<?php 
	if((isset($_POST["consultar"])) && ($_POST["consultar"]=="consul_masc"))
    {
		$id_usuario = $_POST["id_usuario"];
		//consulta para validar que el usuario no se encuentra registrado
		$sql_usu1 = "select * from tb_usuarios where id_usuario = '$id_usuario'";
		$usu = mysqli_query($mysqli,$sql_usu1);
		$row1 = mysqli_fetch_assoc($usu);
		if($_POST["id_usuario"]==""){
			echo "<script>alert('Debe ingresar una cédula del propietario a consultar')</script>";
			echo "<script>window.location = 'listadoMascotas.php'</script>";
		}
		elseif(!$row1){
				echo "<script>alert('El usuario no existe con esos datos')</script>";
				echo "<script>window.location = 'listadoMascotas.php'</script>";
		}
        else
        {
			$id_usuario = $_POST["id_usuario"];
			$nombre_usuario = $_POST["nombre_usuario"];
			$direccion = $_POST["direccion"];
			$correo = $_POST["correo"];
			$telefono = $_POST["telefono"];
			$tarj_prof= $_POST["tarj_prof"];
			$password =  $_POST["password"];
			$id_tipo_usuario = $_POST["id_tipo_usuario"];
			$id_estado = $_POST["id_estado"];
            $sql_usu1 = "insert into tb_usuarios(id_usuario,nombre_usuario,direccion,correo,telefono,tarj_prof,password,id_tipo_usuario,id_estado)
			values('$id_usuario','$nombre_usuario','$direccion','$correo','$telefono','$tarj_prof','$password',$id_tipo_usuario,$id_estado)";
            $tip = mysqli_query($mysqli,$sql_usu1);
            echo "<script>alert('Registro Almacenado Exitosamente')</script>";
			echo "<script>window.location = 'registroUsuario.php'</script>";
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

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../../img/HappyPetIcono.png" type="image/x-icon">
<link rel="stylesheet" href="menuPrincipal/estilos.css">
<title>Consultar Mascotas</title>
</head>
<body>
	<section class="title">
		<h1>LISTADO MASCOTAS</h1>
	</section>
	<main>
		<table border="1" class="center tablaEstilo2">
			<form name="consul_masc" method="POST" autocomplete="off">
				   <tr>
				   		<th colspan="2">CONSULTAR</th>
				   </tr>
				   <tr>
				   		<th>Número de documento</th>
						<td><input type="number" name="id_usuario" placeholder="Ingrese documento"/></td>
				   </tr>
				   <tr>
                   <tr>
                        <th colspan="2">&nbsp;</th>
                    </tr>
				<tr>
					<th colspan="2"><input type="submit" value="Consultar" name="btn-consultar"></th>
					<td><input type="hidden" name="consultar" value="consul_masc"></td>
				</tr>
			</form>
		</table>
</head>
<body>

<h1>Resultados (1)</h1>

<table class="center tablaEstilo">
  <tr>
    <th>ID mascota</th>
    <th>Nombre mascota</th>
    <th>Color</th>
	<th>Raza</th>
    <th>Nombre Propietario</th>
    <th>Tipo mascota</th>
  </tr>
  <tr>
    <td>1</td>
    <td>pipe</td>
    <td>negro cafe</td>
	<td>pastor aleman</td>
    <td>Jimena</td>
    <td>Perros</td>
  </tr>
</table>

</body>

	</main>
</body>
</html>