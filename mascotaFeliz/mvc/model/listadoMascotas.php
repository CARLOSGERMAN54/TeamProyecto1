<?php

    session_start();
    require_once("../db/connection.php");
	include("../controller/validarSesion.php");
	$sql = "SELECT * FROM tb_usuarios, tb_tipo_usuarios WHERE id_usuario = '".$_SESSION['id_usuario']."' AND tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menuPrincipal/estilos.css">
    <title>Document</title>
    </script>
</head>
<body>
    <body>
        <section class="title">
            <h1>FORMULARIO CONSULTAR MASCOTAS</h1>
        </section>
        <table class="center tablaEstilo">
            <tr>
                <td><input type="button" value="Nueva Mascota" onclick="window.location.href='registroMascota.php'"/></td>
            </tr>
        </table>
        <table class="center tablaEstilo">
            <form name="frm_consulta" method="post" autocomplete="off">
                <tr>
                    <th>Id</th>
                    <th>Nombre Mascota</th>
                    <th>Color</th>
                    <th>Raza</th>
                    <th>Id Usuario</th>
                    <th>Id Tipo Mascota</th>
                </tr>
                <?php
                    $sql = "select * from tb_mascotas,tb_usuarios,tb_tipo_mascotas where tb_mascotas.id_usuario=tb_usuarios.id_usuario and tb_mascotas.id_tipo_mascota=tb_tipo_mascotas.id_tipo_mascota";
                    $query = mysqli_query($mysqli,$sql);
                    $i=0;
                    while($result =  mysqli_fetch_assoc($query)){
                           
                ?>
            <tr>
                <td><?php echo $result['id_mascota']?></td>
                <td><?php echo $result['nombre_mascota']?></td>
                <td><?php echo $result['color']?></td>
                <td><?php echo $result['raza']?></td>
                <td><?php echo $result['id_usuario']?></td>
                <td><?php echo $result['id_tipo_mascota']?></td>
                <td><input readonly type="button"  value="Eliminar" onclick="window.open('operacionesMascota.php?id_mascota=<?php echo $result['id_mascota']?>&id_accion=<?php echo 'botonEliminar'; ?>','','width= 600,height=500, toolbar=NO');void(null);"/></td>
                <td><input readonly type="button"  value="Actualizar" onclick="window.open('operacionesMascota.php?id_mascota=<?php echo $result['id_mascota']?>&id_accion=<?php echo 'botonActualizar'; ?>','','width= 600,height=500, toolbar=NO');void(null);"/></td>
            </tr>
            <?php
                    $i++; 
                    }
            ?>
            </form>
        </table>
    </body>
</body>
</html>