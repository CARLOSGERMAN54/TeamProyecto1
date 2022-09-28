<?php
    session_start();
    require_once("../db/connection.php");
	include("../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
?>

<?php 
	if((isset($_POST["guardar"])) && ($_POST["guardar"]=="frm_mas"))
    {
		$nombre_mascota = $_POST["nombre_mascota"];
		$color = $_POST["color"];
		$raza = $_POST["raza"];
		//consulta para validar que la mascota no se encuentra registrado
		$sql_usu1 = "select * from tb_mascotas where nombre_mascota = '$nombre_mascota' and color = '$raza' and color = '$raza'";
		$usu = mysqli_query($mysqli,$sql_usu1);
		$row1 = mysqli_fetch_assoc($usu);
		if($row1){
			echo "<script>alert('La Mascota ya existe con esos datos')</script>";
			echo "<script>window.location = 'registroTipoUsuario.php'</script>";
		}
		elseif($_POST["nombre_mascota"]=="" || $_POST["color"]=="" || $_POST["raza"]=="" || 
			$_POST["id_usuario"]=="" || $_POST["id_tipo_mascota"]=="" ){
				echo "<script>alert('Existen datos vacios')</script>";
				echo "<script>window.location = 'registroUsuario.php'</script>";
		}
        else
        {
			$nombre_mascota = $_POST["nombre_mascota"];
			$color = $_POST["color"];
			$raza = $_POST["raza"];
			$id_usuario = $_POST["id_usuario"];
			$id_tipo_mascota= $_POST["id_tipo_mascota"];
            $sql_usu1 = "insert into tb_mascotas(nombre_mascota,color,raza,id_usuario,id_tipo_mascota)
			values('$nombre_mascota','$color','$raza','$id_usuario','$id_tipo_mascota')";
            $tip = mysqli_query($mysqli,$sql_usu1);
            echo "<script>alert('Registro Almacenado Exitosamente')</script>";
			echo "<script>window.location = 'registroMascota.php'</script>";
        }
	}
?>
<?php
	//tipos
	$sql_tusu = "SELECT * FROM tb_tipo_mascotas";
	$query_tusu = mysqli_query($mysqli,$sql_tusu);
	$fila = mysqli_fetch_assoc($query_tusu);

?>
<form method="POST">
    <table>
        <tr>
            <td colspan='2' align="center"><?php echo $usua['nombre_usuario'] .  "(". $usua['tipo_usuario'].")"?></td>
        </tr>
        <tr>
            <td colspan='2' align="center">
                <input type="submit" value="Cerrar sesión" name="btncerrar" /> 
                <input type="submit" formaction="menuPrincipal/indexMenu.php" value="Regresar" />
            </td>
        </tr>
    <table>
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
<link rel="stylesheet" href="menuPrincipal/estilos.css">
<title>taller</title>
</head>
<body>
	<section class="title">
		<h1>REGISTRO MASCOTA</h1>
	</section>
	<table class="center tablaEstilo">
            <tr>
                <td><input type="button" value="Lista de Mascotas" onclick="window.location.href='listadoMascotas.php'"/></td>
            </tr>
        </table>
	<main>
		<table  class="center tablaEstilo">
			<form name="frm_mas" method="POST" autocomplete="off">
				   <tr>
				   		<th colspan="2">Crear Mascota</th>
				   </tr>
				   <tr>
				   		<td>Nombre Mascota</td>
						<td><input type="tect" name="nombre_mascota" placeholder="eje. Pedro"/></td>
				   </tr>
				   <tr>
						<td>Color Mascota</td>
				 		<td><input type="text" name="color" placeholder="eje. Azul"/></td>
				    </tr>
					<tr>
						<td>Raza Mascota</td>
				 		<td><input type="text" name="raza" placeholder="eje. Bulldog"/></td>
					</tr>
				    </tr>
						<td>Documento Propietario</td>
				 		<td><input type="number" name="id_usuario" placeholder="eje. 1234"/></td>
				    </tr>
						<td>Tipo Usuario</td>
						<td>
							<select name="id_tipo_mascota">
								<option value="">Seleccionar Tipo de Mascota</option>
								<?php 
									do{
								?>
								<option value="<?php echo($fila["id_tipo_mascota"])?>"><?php echo($fila["tipo_mascota"])  ?></option>
							     <?php
									}
									while($fila = mysqli_fetch_assoc($query_tusu));
								 ?>
							</select>
						</td>
					</tr>
					<tr>
					</tr>
				<tr>
					<th colspan="2"><input type="submit" value="Guardar" name="btn-guardar"></th>
					<input type="hidden" name="guardar" value="frm_mas">
				</tr>
			</form>
		</table>


	</main>
</body>
</html>