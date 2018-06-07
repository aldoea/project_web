<?php  
	include "header.php";
	$admin->validar(array('Gerente'));

	$id = isset($_POST['id']) ? $_POST['id'] : null;	
	$proyecto = isset($_POST['proyecto']) ? $_POST['proyecto']: null;	
	$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
	$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
	$origen = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;
	$destino = "../images/marcas/".$imagen;	
		/*
	 __     __    _ _     _            _                       
	 \ \   / /_ _| (_) __| | __ _  ___(_) ___  _ __   ___  ___ 
	  \ \ / / _` | | |/ _` |/ _` |/ __| |/ _ \| '_ \ / _ \/ __|
	   \ V / (_| | | | (_| | (_| | (__| | (_) | | | |  __/\__ \
	    \_/ \__,_|_|_|\__,_|\__,_|\___|_|\___/|_| |_|\___||___/
	                                                           
	*/
	
		$errores = array();
		if (strlen($proyecto) == 0 ) {
			array_push($errores,"Nombre de proyecto demasiado corto");
		}	
		if (!is_numeric($id)) {
			array_push($errores, "Identificador invalido");
		}else{
			$sql = "SELECT id FROM proyecto where id=:id";
			$stmt = $admin->con->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$number_of_rows = count($stmt->fetchAll());
			if ($number_of_rows == 0) {
				array_push($errores, "No existen registros que concuerden para ser actulizados");
			}
		}
		$archivos_permitidos= array("image/jpeg","image/png");	
		$max_size = 200000;
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

		$sql = "UPDATE proyecto SET proyecto=:proyecto, fecha=:fecha, descripcion=:descripcion where id=:id_proyecto";
		if (sizeof($errores) == 0) {
			if ($_FILES['imagen']['error'] == 0) {
				$sql = "UPDATE proyecto SET proyecto=:proyecto, fecha=:fecha, descripcion=:descripcion, imagen=:imagen where id=:id_proyecto";
			}		
			$stmt = $admin->con->prepare($sql);
			$stmt->bindParam(':id_proyecto', $id);
			$stmt->bindParam(':proyecto', $proyecto);
			$stmt->bindParam(':fecha', $fecha);
			$stmt->bindParam(':descripcion', $descripcion);
			if ($_FILES['imagen']['error'] == 0) {				
				$stmt->bindParam(':imagen', $imagen);	
			}
			$stmt->execute();
			$filas_afectadas = $stmt->rowCount();
			echo "Se modificaron ".$filas_afectadas." marcas";
		}else{
			foreach ($errores as $error) {
				echo $error;
				echo "<br/>";
			}
		}	
	?>
	<br/>
	<a href="proyectos.php">back</a>
	<?php  
		include "footer.php";
	?>
