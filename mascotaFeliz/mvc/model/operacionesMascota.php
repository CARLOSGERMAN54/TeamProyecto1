<?php 
session_start();
require_once("../db/connection.php");
include("../controller/validarSesion.php");

//actualizar datos en la tabla tb_usuarios
if(isset($_POST["actualizar"]) && isset($_POST["id_mascota"]))
{
    if($_POST["nombre_mascota"]=="" || $_POST["color"]=="" || 
    $_POST["raza"]=="" || $_POST["id_usuario"]=="" || $_POST["id_tipo_nascota"]=="" ){
        echo "<script>alert('Existen datos vacios')</script>";
        exit();
    }

   $id_mascota = $_POST['id_mascota'];
   $nombre_mascota = $_POST['nombre_mascota'];
   $color = $_POST['color'];
   $raza = $_POST['raza'];
   $id_usuario = $_POST['id_usuario'];
   $id_tipo_mascota = $_POST['id_tipo_mascota'];

   $sql_update="UPDATE tb_mascotas SET nombre_mascota = '$nombre_mascota', color = '$color', raza = '$raza', 
   id_usuario = '$id_usuario', id_tipo_mascota = '$id_tipo_mascota' WHERE id_mascota = '". $id_mascota."'";
   $cs=mysqli_query($mysqli, $sql_update);
   if($cs){
    echo '<script>alert(" Actualización Exitosa ");window.close();window.location.href;</script>';
   }
   else
   {
    echo '<script>alert(" Hay un problema al actualizar los datos ");</script>';
   }
}
//eliminar datos en la tabla tb_usuario
elseif (isset($_POST["eliminar"]) && isset($_POST["id_mascota"])) 
{
    $id_usuario = $_POST["id_mascota"];
    $sql = "delete from tb_mascotas where id_mascota = '$id_mascota'";
    $query = mysqli_query($mysqli, $sql) or die(mysqli_error());
    if($query){
        echo '<script>alert (" Registro Eliminado Exitosamente");window.close();window.location.reload();</script>';
    }
    else{
        echo '<script>alert ("Hay un problema al eliminar el registro");</script>';
    }
}
?>
<?php
	//Traer los tipos de mascotas para colocarlos en los selects
	$sql_tusu = "SELECT * FROM tb_tipo_mascotas";
	$query_tusu = mysqli_query($mysqli,$sql_tusu);
	$fila = mysqli_fetch_assoc($query_tusu);

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menuPrincipal/estilos.css">
    <title>Document</title>
</head>
<body>

<?php
    //condicion para determinar si el usuario presiono el boton actualizar, nos muestra los datos a ser actualizados
    if(isset($_GET["id_accion"]) && $_GET["id_accion"] =="botonActualizar")
    {
        
        $id_usu = $_GET["id_mascota"];  
        $sql_tusu = "SELECT * FROM tb_mascotas where id_mascota = '$id_usu'";
        $query_usu = mysqli_query($mysqli,$sql_tusu);
        $usua = mysqli_fetch_assoc($query_usu);
?>
<table border="1" class="center tablaEstilo">
			<form name="frm_mas" method="POST" action="operacionesMascota.php" autocomplete="off">
				   <tr>
				   		<td colspan="2">Actualizar Mascota</td>
				   </tr>
				   <tr>
					    <td>Nombre Mascota/td>
				 		<td><input type="text" name="nombre_mascota" value="<?php echo $usua["nombre_mascota"]?>"  placeholder="Ingresar nombre de la Mascota"/></td>
				    </tr>
                    <tr>
                        <td>Color</td>
				 		<td><input type="text" name="color" value="<?php echo $usua["color"]?>" placeholder="Ingresar Color"/></td>
                    </tr>
                    <tr>
					    <td>Raza</td>
				 		<td><input type="text" name="raza" value="<?php echo $usua["raza"]?>" placeholder="Ingresar Raza"/></td>
				    </tr>
                    <tr>
						<td>Documento de Usuario</td>
				 		<td><input type="id_usuario" name="id_usuario" value="<?php echo $usua["id_usuario"]?>" placeholder="Ingresar Documento usuario"/></td>
				    </tr>
                    <tr>
						<td>Tipo Mascota</td>
						<td>
							<select name="id_tipo_mascota" >
								<?php 
									
                                    do{
                                        $id_tipo =  $fila["id_tipo_mascota"];
                                        $nombre_tipo = $fila["tipo_mascota"];
                                        if($fila["id_tipo_mascota"] === $usua["id_tipo_mascota"] ){
                                            echo "<option value='$id_tipo' selected='selected'>$nombre_tipo</option>";
                                        }
                                        else{       
								?>
								<option value="<?php echo($fila["id_tipo_mascota"])?>"><?php echo($fila["tipo_mascota"])  ?></option>
							     <?php
                                        }
									}while($fila = mysqli_fetch_assoc($query_tusu));
								 ?>
							</select>
						</td>
					</tr>
					<tr>
					</tr>
				<tr>
					<th colspan="2"><input type="submit" value="Guardar" name="actualizar"></th>
				</tr>
			</form>
		</table>
<?php
//condicion para determinar si el usuario presiono el boton eliminar, nos muestra la confirmacion si deseamos eliminar un registro
}elseif(isset($_GET["id_accion"]) && $_GET["id_accion"] =="botonEliminar"){
    ?>

    <form method="post" action="operacionesUsuario.php">
    <input type="hidden" value="<?php echo $_GET["id_mascota"]; ?>" name="id_mascota">
        <br/><br/><br/><br/><br/><br/>
        <table class="center tablaEstilo">
            <tr>
				<th colspan="2">¿Esta seguro de eliminar el registro?</th>
			</tr>
            <tr>
                <td><input type="submit" value="Si" name="eliminar"></td>
                <td><input type="button" value="No" name="cancelar" onclick="window.close()"></td>
            </tr>
        </table>
    </form>
<?php
}?>
</body>
</html>


             
