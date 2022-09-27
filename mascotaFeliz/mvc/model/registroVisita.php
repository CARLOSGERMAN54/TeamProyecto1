<?php
    session_start();
    require_once("../db/connection.php");
	include("../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
?>
<?php 
	if((isset($_POST["guardar"])) && ($_POST["guardar"]=="frm_usu"))
    {
		$id_usuario = $_POST["id_usuario"];
		$nombre_usuario = $_POST["nombre_usuario"];
		$correo = $_POST["correo"];
		//consulta para validar que el usuario no se encuentra registrado
		$sql_usu1 = "select * from tb_usuarios where id_usuario = '$id_usuario' and correo = '$correo'";
		$usu = mysqli_query($mysqli,$sql_usu1);
		$row1 = mysqli_fetch_assoc($usu);
		if($row1){
			echo "<script>alert('El tipo usuario ya existe con esos datos')</script>";
			echo "<script>window.location = 'registroTipoUsuario.php'</script>";
		}
		elseif($_POST["id_usuario"]=="" || $_POST["nombre_usuario"]=="" || $_POST["direccion"]=="" || 
			$_POST["correo"]=="" || $_POST["tarj_prof"]=="" || $_POST["password"]=="" || $_POST["telefono"]=="" || $_POST["id_tipo_usuario"]=="" || $_POST["id_estado"]==""){
				echo "<script>alert('Existen datos vacios')</script>";
				echo "<script>window.location = 'registroUsuario.php'</script>";
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
<?php
	//tipos
	$sql_tmas = "SELECT * FROM tb_mascotas";
	$query_tmas = mysqli_query($mysqli,$sql_tmas);
	$fila = mysqli_fetch_assoc($query_tusu);

	//estados
	$sql_est = "SELECT * FROM tb_estados";
	$query_est = mysqli_query($mysqli,$sql_est);
	$fila_est = mysqli_fetch_assoc($query_est);
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
		<h1>REGISTRO VISITA</h1>
	</section>
	<table class="center tablaEstilo">
            <tr>
                <td><input type="button" value="Reporte de Visitas" onclick="window.location.href='listaUsuarios.php'"/></td>
            </tr>
        </table>
	<main>
		<table  class="center tablaEstilo">
			<form name="frm_usu" method="POST" autocomplete="off">
				   <tr>
				   		<th colspan="2">Registro Visitas</th>
				   </tr>
				   <tr>
				   		<td>Temperatura(C°)</td>
						<td><input type="number" name="temperatura" placeholder="eje. 35.5" /></td>
				   </tr>
				   <tr>
						<td>Frecuencia Respiratoria</td>
				 		<td><input type="number" name="frec_respiratoria" placeholder="eje. 45"/></td>
				   </tr>
					<tr>
						<td>Frecuencia Cardiaca</td>
				 		<td><input type="number" name="frec_cardiaca" placeholder="eje. 56"/></td>
					</tr>
				    <tr>
						<td>Peso(Kg)</td>
				 		<td><input type="number" name="peso" placeholder="eje. 30"/></td>
                    </tr>
                    <tr>
						<td>Costo</td>
				 		<td><input type="number" name="costo" placeholder="eje. 20300"/></td>
				    </tr>

                    </tr>
						<td>Identificación Propietario</td>
				 		<td><input type="text" name="id_usuario" placeholder="eje. 20300"/></td>
				    </tr>
					
					<tr>
						<td>Selecciona Mascota</td>
						<td>
							<select name="id_mascota">
								<option value="">Seleccionar Mascota</option>
								<?php 
									do{
								?>
								<option value="<?php echo($fila["id_mascota"])?>"><?php echo($fila["nombre_mascota"])  ?></option>
							     <?php
									}
									while($fila = mysqli_fetch_assoc($query_tusu));
								 ?>
							</select>
						</td>
					</tr>
                    </tr>
						<td>Recomendación</td>
				 		<td>
                            <textarea name="recomendacion" cols="30" rows="10"></textarea>
                        </td>
				    </tr>
                    <tr>
                        <th colspan="2"><input type="submit" value="Guardar" name="btn-guardar"></th>
                        <input type="hidden" name="guardar" value="frm_usu">
                    </tr>
			</form>
		</table>
	</main>
</body>
</html>