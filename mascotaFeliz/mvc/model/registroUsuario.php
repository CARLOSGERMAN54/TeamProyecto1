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
	$sql_tusu = "SELECT * FROM tb_tipo_usuarios";
	$query_tusu = mysqli_query($mysqli,$sql_tusu);
	$fila = mysqli_fetch_assoc($query_tusu);

	//estados
	$sql_est = "SELECT * FROM tb_estados";
	$query_est = mysqli_query($mysqli,$sql_est);
	$fila_est = mysqli_fetch_assoc($query_est);

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
<link rel="stylesheet" href="menuPrincipal/estilos.css">
<title>taller</title>
</head>
<body>
	<section class="title">
		<h1>REGISTRO USUARIO</h1>
	</section>
	<main>
		<table border="1" class="center">
			<form name="frm_usu" method="POST" autocomplete="off">
				   <tr>
				   		<th colspan="2">Crear Usuario</th>
				   </tr>
				   <tr>
				   		<th>Documento Indetificacion</th>
						<th><input type="number" name="id_usuario" placeholder="Ingrese documento usuario"/></th>
				   </tr>
				   <tr>
					<th>Nombre Usuario</th>
				 		<th><input type="text" name="nombre_usuario" placeholder="Ingresar nombre de Usuario"/></th>
				    </tr>
					<th>Direccion</th>
				 		<th><input type="text" name="direccion" placeholder="Ingresar Dirección"/></th>
				    </tr>
					<th>Correo</th>
				 		<th><input type="email" name="correo" placeholder="Ingresar correo"/></th>
				    </tr>
					<th>Teléfono</th>
				 		<th><input type="number" name="telefono" placeholder="Ingresar telefono"/></th>
				    </tr>
					<th>Tarjeta Profesional</th>
				 		<th><input type="text" name="tarj_prof" placeholder="Ingresar telefono"/></th>
				    </tr>
						<th>Contraseña</th>
				 		<th><input type="password" name="password" placeholder="Ingresar telefono"/></th>
				    </tr>
					
					<tr>
						<th>Tipo Usuario</th>
						<th>
							<select name="id_tipo_usuario">
								<option value="">Seleccionar Tipo de Usuario</option>
								<?php 
									do{
								?>
								<option value="<?php echo($fila["id_tipo_usuario"])?>"><?php echo($fila["tipo_usuario"])  ?></option>
							     <?php
									}
									while($fila = mysqli_fetch_assoc($query_tusu));
								 ?>
							</select>
						</th>
					</tr>
					<tr>
					<th>Estado</th>
						<th>
							<select name="id_estado">
								<option value="">Seleccionar Tipo de Usuario</option>
								<?php 
									do{
								?>
								<option value="<?php echo($fila_est["id_estado"])?>"><?php echo($fila_est["nombre_estado"]) ?></option>
							     <?php
									}
									while($fila_est = mysqli_fetch_assoc($query_est));
								 ?>
							</select>
						</th>
					</tr>


                    <tr>
                        <th colspan="2">&nbsp;</th>
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