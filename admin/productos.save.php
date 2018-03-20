<?php  
	include "header.php";
	//print_r($_POST);
	$nombre = $_POST['nombre'];
	$precio = $_POST['precio'];
	$precio_desc = $_POST['precio_desc'];
	$id_marca = $_POST['marca'];
	$imagen = $_POST['imagen'];

	$sql = "INSERT INTO producto (nombre, id_marca, precio, precio_desc, imagen) values ('$nombre', $id_marca, $precio, $precio_desc, '$imagen')";
	
	$filas_afectadas = $admin -> execute($sql);
	echo "Se insertaron ".$filas_afectadas." productos";
?>
<a href="productos.php">back</a>
<?php  
	include "footer.php";
?>