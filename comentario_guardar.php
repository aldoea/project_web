<?php
	include "header.php";
	$nombre = $_GET['nombre'];
	$appellido = $_GET['apellido'];
	$email = $_GET['email'];
	$telefono = $_GET['telefono'];
	$comentario = $_GET['comentario'];

	$line = "$nombre|$appellido|$email|$telefono|$comentario";

	$commentsFile = fopen("comments.txt", "a");	
	fwrite($commentsFile, $line.PHP_EOL);	
	fwrite($commentsFile, "------------------------------------".PHP_EOL);	
	fclose($commentsFile);

	echo "Gracias $nombre $appellido por tus comentarios";
	include "footer.php";
 ?>