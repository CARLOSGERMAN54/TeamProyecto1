<?php
  require_once("db/connection.php");
?>
<?php
    $control = "SELECT * From tb_tipo_usuarios WHERE id_tipo_usuario >= 2";
    $query=mysqli_query($mysqli,$control);
    $fila=mysqli_fetch_assoc($query);
?>
<?php
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {
        $id_usuario =    $_POST['id_usuario'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $password = $_POST['password'];
        $tarj_prof = $_POST['tarj_prof'];
        $id_tipo_usuario = $_POST['id_tipo_usuario'];
        $id_estado = 1;

        $validar ="SELECT * FROM tb_usuarios WHERE id_usuario='$id_usuario'";
        $queryi=mysqli_query($mysqli,$validar);
        $fila1=mysqli_fetch_assoc($queryi);
    
       if ($fila1) {
           echo '<script>alert ("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
       }
        else if ($id_usuario=="" || $nombre_usuario=="" || $direccion=="" || $correo=="" || $telefono=="" || $password=="" || $id_tipo_usuario=="" || $id_estado=="")
        {
            echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
            echo '<script>windows.location="registrousu.php"</script>';
        }

        else
        {
           $insertsql="INSERT INTO tb_usuarios(id_usuario,nombre_usuario,direccion,correo,telefono,password,tarj_prof,id_tipo_usuario,id_estado) 
                                    VALUES('$id_usuario','$nombre_usuario','$direccion','$correo','$telefono','$password','$tarj_prof',$id_tipo_usuario,$id_estado)";
           mysqli_query($mysqli,$insertsql) or die(mysqli_error());
           echo '<script>alert (" Registro Exitoso, Gracias");</script>';
           echo '<script>window.location="index.html"</script>';
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="controller/css/style.css">
    <style>
        .ocultar{
            display: none;
        }
        .mostrar{
            display: show;
        }
    </style>
    <title>Document</title>
    <script>
        const d = document;
        
        d.addEventListener("change",(e)=>{
            const $tipo_usuario = d.getElementById("id_tipo_usuario"),
                  $tarj_prof = d.getElementById("tarj_prof");
            if(e.target === $tipo_usuario){
                if(e.target.value==3){
                    $tarj_prof.classList.add("mostrar");
                    $tarj_prof.classList.remove("ocultar");
                }
                else{
                    $tarj_prof.classList.remove("mostrar");
                    $tarj_prof.classList.add("ocultar");
                } 
            }
        });
    </script>
</head>
<body>
    <div class="login-box">
        <img src="controller/image/logo1.png" class="avatar" alt="Imagen Avar">              
        <form method="POST" name="formreg" autocomplete="off">
            <label for="usuario"> REGISTRO DE USUARIOS </label> 
            <input type="text" name="id_usuario" placeholder="Ingrese Documento Identidad" >
            <input type="text" name="nombre_usuario" placeholder="Ingrese Nombres Completos" >
            <input type="text" name="direccion" placeholder="Ingrese direccion" >
            <input type="text" name="correo" placeholder="Ingrese correo electrónicp" >
            <input type="text" name="telefono" placeholder="Ingrese telefono" >

            <label for="usuario">Tipo de usuario</label>
            <select name="id_tipo_usuario" id="id_tipo_usuario">
                <option value="">Seleccionar</option>
               <?php
                   do {
                
                ?>
                    <option value="<?php echo($fila['id_tipo_usuario'])?>"> <?php echo($fila['tipo_usuario'])?>

               <?php   
                   }while($fila=mysqli_fetch_assoc($query));
               
               ?>
            </select>



            <input type="text" name="tarj_prof" id="tarj_prof" class="ocultar" placeholder="Ingrese targeta profesional">
            <input type="password" name="password" placeholder="Ingrese Contraseña" >         
            <!--select-->
            <input type="submit" name="validar" value="Registrarme">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>


    
    </div>
</body>
</html>