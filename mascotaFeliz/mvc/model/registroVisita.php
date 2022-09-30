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

		if($_POST["temperatura"]=="" || $_POST["frec_respiratoria"]=="" || $_POST["frec_cardiaca"]=="" || 
			$_POST["peso"]=="" || $_POST["recomendacion"]=="" || $_POST["costo"]=="" || $_POST["id_mascota"]==""){
				echo "<script>alert('Existen datos vacios')</script>";
				echo "<script>window.location = 'registroVisita.php'</script>";
		}
        else
        {
			$fecha_actual = date('Y-m-d H:i:s');
			$temperatura = $_POST["temperatura"];
			$frec_respiratoria = $_POST["frec_respiratoria"];
			$frec_cardiaca = $_POST["frec_cardiaca"];
			$peso = $_POST["peso"];
			$recomendacion = $_POST["recomendacion"];
			$costo = $_POST["costo"];
			$id_mascota = $_POST["id_mascota"];
			$id_estado = 1;
			$id_usuario = $_SESSION['id_usuario'];
            $sql_visit = "insert into tb_visitas(fecha,temperatura,frec_respiratoria,frec_cardiaca,peso,recomendacion,costo,id_mascota,id_estado,id_usuario)
			values('$fecha_actual',$temperatura,$frec_respiratoria,$frec_cardiaca,'$peso',
			'$recomendacion',$costo,$id_mascota,$id_estado,'$id_usuario')";
            $tip = mysqli_query($mysqli,$sql_visit);
			if($tip)
			{
				echo "<script>alert('Registro Almacenado Exitosamente')</script>";
				echo "<script>window.location = 'registroVisita.php'</script>";
			}
			else{
				echo "<script>alert('Hubo un problema al guardar el registro. Intentalo mas tarde')</script>";
			}
        }
	}
?>
<?php
	//tipos
	$sql_tmas = "SELECT mas.id_mascota,mas.nombre_mascota,
	   mas.color,mas.raza,mas.id_usuario,usu.nombre_usuario,
	   tip.id_tipo_mascota,tip.tipo_mascota
	 FROM tb_mascotas mas inner join tb_usuarios usu on mas.id_usuario = usu.id_usuario
	                      inner join tb_tipo_mascotas tip on mas.id_tipo_mascota = tip.id_tipo_mascota 
						  where usu.id_tipo_usuario = 3;";
	$query_tmas = mysqli_query($mysqli,$sql_tmas);
	$fila = mysqli_fetch_assoc($query_tmas);
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
						<td>Selecciona Mascota</td>
						<td>
							<select name="id_mascota">
								<option value="">Seleccionar Mascota</option>
								<?php 
									do{
								?>
								<option value="<?php echo($fila["id_mascota"])?>"><?php echo("Mascota(".$fila["nombre_mascota"]." ".$fila["tipo_mascota"].") Propietario(".$fila["id_usuario"]." ".$fila["nombre_usuario"].")")  ?></option>
							     <?php
									}
									while($fila = mysqli_fetch_assoc($query_tmas));
								 ?>
							</select>
						</td>
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
                    <tr>
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