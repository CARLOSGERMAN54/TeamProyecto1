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
            <h1>FORMULARIO CONSULTAR USUARIOS</h1>
        </section>
        <table class="center tablaEstilo">
            <tr>
                <td><input type="button" value="Nuevo Usuario" onclick="window.location.href='registroUsuario.php'"/></td>
            </tr>
        </table>
        <table class="center tablaEstilo">
            <form name="frm_consulta" method="post" autocomplete="off">
                <tr>
                    <th>Id</th>
                    <th>Cedula</th>
                    <th>Nombre usuario</th>
                    <th>direccion</th>
                    <th>correo</th>
                    <th>telefono</th>
                    <th>tarj prof</th>
                    <th>Tipo usuario</th>
                    <th>Estado</th>
                </tr>
                <?php
                    $sql = "select * from tb_usuarios,tb_estados,tb_tipo_usuarios where tb_usuarios.id_estado = tb_estados.id_estado and tb_usuarios.id_tipo_usuario = tb_tipo_usuarios.id_tipo_usuario";
                    $query = mysqli_query($mysqli,$sql);
                    $i=0;
                    while($result =  mysqli_fetch_assoc($query)){
                           
                ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $result['id_usuario']?></td>
                <td><?php echo $result['nombre_usuario']?></td>
                <td><?php echo $result['direccion']?></td>
                <td><?php echo $result['correo']?></td>
                <td><?php echo $result['telefono']?></td>
                <td><?php echo $result['tarj_prof']?></td>
                <td><?php echo $result['tipo_usuario']?></td>
                <td><?php echo $result['nombre_estado']?></td>
                <td><input readonly type="button"  value="Eliminar" onclick="window.open('operacionesUsuario.php?id_usuario=<?php echo $result['id_usuario']?>&id_accion=<?php echo 'botonEliminar'; ?>','','width= 600,height=500, toolbar=NO');void(null);"/></td>
                <td><input readonly type="button"  value="Actualizar" onclick="window.open('operacionesUsuario.php?id_usuario=<?php echo $result['id_usuario']?>&id_accion=<?php echo 'botonActualizar'; ?>','','width= 600,height=500, toolbar=NO');void(null);"/></td>
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