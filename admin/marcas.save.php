<?php  
	include "header.php";	
	$marca = isset($_POST['marca']) ? $_POST['marca'] : null;	
	$origen = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;
	$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
	$destino = "../images/marcas/".$imagen;	
	/*
	 __     __    _ _     _            _                       
	 \ \   / /_ _| (_) __| | __ _  ___(_) ___  _ __   ___  ___ 
	  \ \ / / _` | | |/ _` |/ _` |/ __| |/ _ \| '_ \ / _ \/ __|
	   \ V / (_| | | | (_| | (_| | (__| | (_) | | | |  __/\__ \
	    \_/ \__,_|_|_|\__,_|\__,_|\___|_|\___/|_| |_|\___||___/
	                                                           
	*/

	$errores = array();
	if (strlen($marca) == 0 ) {
		array_push($errores,"Nombre de marca demasiado corto");
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

	$sql = "INSERT INTO marca (marca, imagen) values (:marca, :imagen)";
	
	if (sizeof($errores) == 0) {
		$stmt = $admin->con->prepare($sql);
		$stmt->bindParam(':marca', $marca);
		$stmt->bindParam(':imagen', $imagen);	
		$stmt->execute();
		$filas_afectadas = $stmt->rowCount();
		echo "Se insertaron ".$filas_afectadas." marcas";
	}else{
		foreach ($errores as $error) {
			echo $error;
			echo "<br/>";
		}
	}	
?>
<br/>
<a href="marcas.php">back</a>
<?php  
	include "footer.php";
?>