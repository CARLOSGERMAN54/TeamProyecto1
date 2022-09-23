<?php 
session_start();
require_once("../db/connection.php");
include("../controller/validarSesion.php");

//actualizar datos en la tabla tb_usuarios
if(isset($_POST["actualizar"]) && isset($_POST["id_usuario"]))
{
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
   echo $sql_update;
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
    <title>Document</title>
    <script>
        function centrar() { 
            iz=(screen.width-document.body.clientWidth) / 2; 
            de=(screen.height-document.body.clientHeight) / 2; 
            moveTo(iz,de); 
        } 
        centrar();    
</script>
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
<table border="1" class="center">
			<form name="frm_usu" method="POST" action="operacionesUsuario.php" autocomplete="off">
				   <tr>
				   		<th colspan="2">Actualizar usuario</th>
				   </tr>
				   <tr>
				   		<th>Documento Indetificacion</th>
						<th><input type="number" name="id_usuario" readonly value="<?php echo $usua["id_usuario"]?>" placeholder="Ingrese documento usuario"/></th>
				   </tr>
				   <tr>
					<th>Nombre Usuario</th>
				 		<th><input type="text" name="nombre_usuario" value="<?php echo $usua["nombre_usuario"]?>"  placeholder="Ingresar nombre de Usuario"/></th>
				    </tr>
					<th>Direccion</th>
				 		<th><input type="text" name="direccion" value="<?php echo $usua["direccion"]?>" placeholder="Ingresar Dirección"/></th>
				    </tr>
					<th>Correo</th>
				 		<th><input type="email" name="correo" value="<?php echo $usua["correo"]?>" placeholder="Ingresar correo"/></th>
				    </tr>
					<th>Teléfono</th>
				 		<th><input type="number" name="telefono" value="<?php echo $usua["telefono"]?>" placeholder="Ingresar telefono"/></th>
				    </tr>
					<th>Tarjeta Profesional</th>
				 		<th><input type="text" name="tarj_prof" value="<?php echo $usua["tarj_prof"]?>" placeholder="Ingresar telefono"/></th>
				    </tr>
						<th>Contraseña</th>
				 		<th><input type="password" name="password" value="<?php echo $usua["password"]?>" placeholder="Ingresar telefono"/></th>
				    </tr>
					
					<tr>
						<th>Tipo Usuario</th>
						<th>
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
						</th>
					</tr>
					<tr>
					<th>Estado</th>
						<th>
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
						</th>
					</tr>
                    <tr>
                        <th colspan="2">&nbsp;</th>
                    </tr>
				<tr>
					<th colspan="2"><input type="submit" value="Guardar" name="actualizar"></th>
				</tr>
			</form>
		</table>
<?php
//condicion para determinar si el usuario presiono el boton eliminar, nos muestra la confirmacion si deseamos eliminar un registro
}elseif(isset($_GET["id_accion"]) && $_GET["id_accion"] =="botonEliminar"){
    echo "<h2>Esta seguro de eliminar el registro</h2>";
    ?>
    <form method="post" action="operacionesUsuario.php">
    <input type="hidden" value="<?php echo $_GET["id_usuario"]; ?>" name="id_usuario">
        <table>
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


             
