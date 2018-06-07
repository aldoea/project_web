<?php  
	include "header.php";
	$id_proyecto = null;	
	if (isset($_GET['id_proyecto'])) {
		if (is_numeric($_GET['id_proyecto'])) {
				$id_proyecto = $_GET['id_proyecto'];
			}	
	}	

	$sql = "SELECT * FROM proyecto WHERE id=:id_proyecto";
	$stmt = $admin->con->prepare($sql);
	$stmt->bindParam(':id_proyecto', $id_proyecto);
	$stmt->execute();	
	$proyectos = $stmt->fetch(PDO::FETCH_ASSOC);
	$id = isset($proyectos['id']) ? $proyectos['id'] : null;
	$proyecto = isset($proyectos['proyecto']) ? $proyectos['proyecto']: null;	
	$fecha = isset($proyectos['fecha']) ? $proyectos['fecha'] : null;
	$descripcion = isset($proyectos['descripcion']) ? $proyectos['descripcion'] : null;	

?>
<div class="container-fluid mx-auto">
	<h1>Formulario de proyectos</h1>
		<form method="post" action="proyectos.update.php" enctype="multipart/form-data">
		  	<div class="form-group">		  		
		  		<?php echo '
		  			<input type="hidden" name="id" class="form-control" id="id" aria-describedby="id" placeholder="id" value="'.$id.'" required="true">		  		
			    	<label for="Proyecto">proyecto</label>
				    <input type="text" name="proyecto" class="form-control" id="proyecto" aria-describedby="proyecto" value="'.$proyecto.'" placeholder="Nombre de la proyecto" required="true">
				    <label>Fecha</label>
				    <input type="date" name="fecha" value="'.$fecha.'" class="form-control" aria-describedby="marca" placeholder="Fecha de caducidad">
				    <label>Descripción</label>
				    <textarea name="descripcion" class="form-control" placeholder="'.$descripcion.'"></textarea>		    
			    '?>
			    <label for="imagen">Imagen</label>
			    <input type="file" name="imagen" class="form-control-file" id="imagen" aria-describedby="imagen">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		  	<button type="reset" class="btn btn-danger">Reset</button>
		</form>
</div>

<?php  
	include "footer.php";
?>