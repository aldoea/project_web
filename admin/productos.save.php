<?php  
	include "header.php";	
	$admin->validar(array('Gerente'));
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
	$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
	$precio_desc = isset($_POST['precio_desc']) ? $_POST['precio_desc'] : null;
	$id_marca = isset($_POST['marca']) ? $_POST['marca'] : null;
	$origen = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;
	$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
	$destino = "../images/productos/".$imagen;
	/*
	 __     __    _ _     _            _                       
	 \ \   / /_ _| (_) __| | __ _  ___(_) ___  _ __   ___  ___ 
	  \ \ / / _` | | |/ _` |/ _` |/ __| |/ _ \| '_ \ / _ \/ __|
	   \ V / (_| | | | (_| | (_| | (__| | (_) | | | |  __/\__ \
	    \_/ \__,_|_|_|\__,_|\__,_|\___|_|\___/|_| |_|\___||___/
	                                                           
	*/

	$errores = array();
	if (strlen($nombre) == 0 ) {
		array_push($errores,"Nombre producto demasiado corto");
	}
	if (!is_numeric($id_marca)) {
		array_push($errores, "Identificador invalido");
	}else{
		$sql = "SELECT id FROM marca where id=:id";
		$stmt = $admin->con->prepare($sql);
		$stmt->bindParam(':id', $id_marca);
		$stmt->execute();
		$number_of_rows = count($stmt->fetchAll());
		if ($number_of_rows == 0) {
			array_push($errores, "No existe la marca seleccionada");
		}
	}
	if (!is_numeric($precio)) {
	 	array_push($errores, "Se requiere un número");
	} 
	if (!is_null($precio_desc)) {
		if (!is_numeric($precio_desc)) {
			array_push($errores, "Se requiere un descuento");
		}elseif ($precio_desc > $precio) {
			array_push($errores, "El precio de descuento debe ser menor al precio normal");
		}		
	}

	$archivos_permitidos= array("image/jpeg","image/png");	
	$max_size = 50 * 1024;
	if ($_FILES['imagen']['error'] != 4) {
		if ($_FILES['imagen']['error'] == 0) {
			if (in_array($_FILES['imagen']['type'], $archivos_permitidos)) {
				if ($_FILES['imagen']['size'] < $max_size) {
					if (move_uploaded_file($origen, $destino)) {
						echo "Se subio la imagen correctamente";
						echo "<br/>";
					}else{
						array_push($errores, "Error desconocido, no se subio la imagen");
					}	
				}else{
					array_push($errores, "Imagen muy grande, tamaño maximo: 50KB");				
				}		
			}else{
				array_push($errores, "Archivo no valido");			
			}			
		}else{
			array_push($errores, "Error desconocido, contacte a soporte");
		}
	}
	
	$sql = "INSERT INTO producto (nombre, id_marca, precio, precio_desc, imagen) values (:nombre, :id_marca, :precio, :precio_desc, :imagen)";
	
	if (sizeof($errores) == 0) {
		$stmt = $admin->con->prepare($sql);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':id_marca', $id_marca);
		$stmt->bindParam(':precio', $precio);
		$stmt->bindParam(':precio_desc', $precio_desc);
		$stmt->bindParam(':imagen', $imagen);	
		$stmt->execute();
		$filas_afectadas = $stmt->rowCount();
		echo "Se insertaron ".$filas_afectadas." productos";
	}else{
		foreach ($errores as $error) {
			echo $error;
			echo "<br/>";
		}
	}	
?>
<br/>
<a href="productos.php">back</a>
<?php  
	include "footer.php";
?>