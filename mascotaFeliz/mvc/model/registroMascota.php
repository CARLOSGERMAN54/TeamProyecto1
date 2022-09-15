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

<form method="POST">
	<tr>
		<td colspan='2' align="center"><?php echo $usua['nombre_usuario'] .  "(". $usua['tipo_usuario'].")"?></td>
	</tr>
	<tr><br>
	<td colspan='2' align="center">
		<input type="submit" value="Cerrar sesión" name="btncerrar" />
	</td>
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
<link rel="stylesheet" href="menuPrincipal/estilos.css">
<title>taller</title>
</head>
<body>
	<section class="title">
		<h1>REGISTRO DE MASCOTAS</h1>
	</section>
	<main>
		<form method="POST" name="form1" id="form1" action="controller/inicio.php" autocomplete="off">
            <input type="text" name="nombre_mascota" id="nombre_mascota" placeholder="Digite el nombre de la mascota">
			<input type="text" name="color" id="color" placeholder="Digite el color de la mascota">
			<input type="text" name="raza" id="raza" placeholder="Digite la raza de la mascota">
			<input type="text" name="id_usuario" id="id_usuario" placeholder="Digite el documento del propietario">
            <select name="id_tipo_mascota" id="id_tipo_mascota">
                <option value="">Seleccionar</option>
               <?php
                   while($mascotas=mysqli_fetch_assoc($query)){
                
                ?>
                    <option value="<?php echo($mascotas['id_tipo_mascota'])?>"> <?php echo($mascotas['tipo_mascota'])?>

               <?php   
                   }
               
               ?>
            </select>     
            <!--select-->
            <input type="submit" name="registro_mascota" value="Guardar">
            <input type="hidden" name="MM_insert" value="formmas">
        </form>
	</main>
</body>
</html>