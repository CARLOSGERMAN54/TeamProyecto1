<?php 
session_start();
require_once("../db/connection.php");
include("../controller/validarSesion.php");

//actualizar datos en la tabla tb_usuarios
if(isset($_POST["actualizar"]) && isset($_POST["id_usuario"]))
{
    if($_POST["id_usuario"]=="" || $_POST["nombre_usuario"]=="" || $_POST["direccion"]=="" || 
    $_POST["correo"]=="" || $_POST["tarj_prof"]=="" || $_POST["password"]=="" || $_POST["telefono"]=="" || $_POST["id_tipo_usuario"]=="" || $_POST["id_estado"]==""){
        echo "<script>alert('Existen datos vacios')</script>";
        exit();
    }

   $id_usuario = $_POST['id_usuario'];
   $nombre_usuario = $_POST['nombre_usuario'];
   $direccion = $_POST['direccion'];
   $correo = $_POST['correo'];
   $telefono = $_POST['telefono'];
   $password = $_POST['password'];
   $tarj_prof = $_POST['tarj_prof'];
   $id_tipo_usuario = $_POST['id_tipo_usuario'];
   $id_estado = $_POST['id_estado'];


   $sql_update="UPDATE tb_usuarios SET nombre_usuario = '$nombre_usuario', direccion = '$direccion', correo = '$correo', 
   telefono = '$telefono', password = '$password',tarj_prof = '$tarj_prof',id_tipo_usuario = $id_tipo_usuario,id_estado = $id_estado WHERE id_usuario = '". $id_usuario."'";
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
elseif (isset($_POST["eliminar"]) && isset($_POST["id_usuario"])) 
{
    $id_usuario = $_POST["id_usuario"];
    $sql = "delete from tb_usuarios where id_usuario = '$id_usuario'";
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
	//Traer los tipos de usuarios para colocarlos en los selects
	$sql_tusu = "SELECT * FROM tb_tipo_usuarios";
	$query_tusu = mysqli_query($mysqli,$sql_tusu);
	$fila = mysqli_fetch_assoc($query_tusu);

	//Traer los estados para los usuarios y colocarlos en los selects
	$sql_est = "SELECT * FROM tb_estados";
	$query_est = mysqli_query($mysqli,$sql_est);
	$fila_est = mysqli_fetch_assoc($query_est);
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
        
        $id_usu = $_GET["id_usuario"];  
        $sql_tusu = "SELECT * FROM tb_usuarios where id_usuario = '$id_usu'";
        $query_usu = mysqli_query($mysqli,$sql_tusu);
        $usua = mysqli_fetch_assoc($query_usu);
?>
<table border="1" class="center tablaEstilo">
			<form name="frm_usu" method="POST" action="operacionesUsuario.php" autocomplete="off">
				   <tr>
				   		<td colspan="2">Actualizar usuario</td>
				   </tr>
				   <tr>
				   		<td>Documento Indetificacion</td>
						<td><input type="number" name="id_usuario" readonly value="<?php echo $usua["id_usuario"]?>" placeholder="Ingrese documento usuario"/></td>
				   </tr>
				   <tr>
					    <td>Nombre Usuario</td>
				 		<td><input type="text" name="nombre_usuario" value="<?php echo $usua["nombre_usuario"]?>"  placeholder="Ingresar nombre de Usuario"/></td>
				    </tr>
                    <tr>
                        <td>Direccion</td>
				 		<td><input type="text" name="direccion" value="<?php echo $usua["direccion"]?>" placeholder="Ingresar Dirección"/></td>
                    </tr>
                    <tr>
					    <td>Correo</td>
				 		<td><input type="email" name="correo" value="<?php echo $usua["correo"]?>" placeholder="Ingresar correo"/></td>
				    </tr>
                    <tr>
					    <td>Teléfono</td>
				 		<td><input type="number" name="telefono" value="<?php echo $usua["telefono"]?>" placeholder="Ingresar telefono"/></td>
				    </tr>
                    <tr>
					    <td>Tarjeta Profesional</td>
				 		<td><input type="text" name="tarj_prof" value="<?php echo $usua["tarj_prof"]?>" placeholder="Ingresar telefono"/></td>
				    </tr>
						<td>Contraseña</td>
				 		<td><input type="password" name="password" value="<?php echo $usua["password"]?>" placeholder="Ingresar telefono"/></td>
				    </tr>
                    <tr>
						<td>Tipo Usuario</td>
						<td>
							<select name="id_tipo_usuario" >
								<?php 
									
                                    do{
                                        $id_tipo =  $fila["id_tipo_usuario"];
                                        $nombre_tipo = $fila["tipo_usuario"];
                                        if($fila["id_tipo_usuario"] === $usua["id_tipo_usuario"] ){
                                            echo "<option value='$id_tipo' selected='selected'>$nombre_tipo</option>";
                                        }
                                        else{       
								?>
								<option value="<?php echo($fila["id_tipo_usuario"])?>"><?php echo($fila["tipo_usuario"])  ?></option>
							     <?php
                                        }
									}while($fila = mysqli_fetch_assoc($query_tusu));
								 ?>
							</select>
						</td>
					</tr>
					<tr>
					<td>Estado</td>
						<td>
							<select name="id_estado" value="<?php echo $usua["id_estado"]?>">
								<?php 
                                    do{
                                        $id_estado =  $fila_est["id_estado"];
                                        $nombre_estado = $fila_est["nombre_estado"];
                                        if($fila_est["id_estado"] === $usua["id_estado"] ){
                                            echo "<option value='$id_estado' selected='selected'>$nombre_estado</option>";
                                        }
                                        else{       
                                                                    
								?>
								<option value="<?php echo($fila_est["id_estado"])?>"><?php echo($fila_est["nombre_estado"]) ?></option>
							     <?php
									}
                                }while($fila_est = mysqli_fetch_assoc($query_est));
								 ?>
							</select>
						</td>
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
    <input type="hidden" value="<?php echo $_GET["id_usuario"]; ?>" name="id_usuario">
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


             
