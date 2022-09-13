<?php
//Archivo que permite validar la sesi�n

if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['id_tipo_usuario']))
{
	header("Location: ../index.html");
	exit;
}
?>