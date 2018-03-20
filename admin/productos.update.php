<?php  
	include "header.php";

	$nombre = $_POST['nombre'];
	$precio = $_POST['precio'];
	$precio_desc = $_POST['precio_desc'];
	$id_marca = $_POST['marca'];
	$imagen = $_POST['imagen'];
	$id = $_POST['id'];
	
	$sql = "UPDATE producto SET nombre='$nombre', imagen='$imagen', precio=$precio, precio_desc=$precio_desc, id_marca=$id_marca where id=$id";
	$filas = $admin->execute($sql);
	echo "Se modifico ".$filas." productos";
	include "footer.php";
?>