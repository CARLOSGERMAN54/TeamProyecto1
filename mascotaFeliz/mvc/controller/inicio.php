<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){
	// inicia sesion para los usuarios
	$usuario = $_POST["usuario"];
	//$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from tb_usuarios where id_usuario = '$usuario' and password = '$clave' and id_estado = 1"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);
	if($fila){				
		$_SESSION['id_usuario'] = $fila['id_usuario']; 
		$_SESSION['nombre_usuario'] = $fila['nombre_usuario']; 
		$_SESSION['id_tipo_usuario'] = $fila['id_tipo_usuario'];
		$_SESSION['correo'] = $fila['correo'];
		
				/// dependiendo del tipo de usuario lo redireccinamos a una pagina
		/// si es un client
		if($_SESSION['id_tipo_usuario']){
			header("Location: ../model/menuPrincipal/indexMenu.php"); 
			exit();
		}
		
		
	}else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>