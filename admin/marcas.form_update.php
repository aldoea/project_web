<?php  
	include "header.php";
	$id_marca = null;	
	if (isset($_GET['id_marca'])) {
		if (is_numeric($_GET['id_marca'])) {
				$id_marca = $_GET['id_marca'];
			}	
	}	

	$sql = "SELECT * FROM marca where id=:id_marca";
	$stmt = $admin->con->prepare($sql);
	$stmt->bindParam(':id_marca', $id_marca);
	$stmt->execute();	
	$marcas =(array) $stmt->fetchObject();	
	$id = isset($marcas['id']) ? $marcas['id'] : null;
	$marca = isset($marcas['marca']) ? $marcas['marca']: null;		

?>
<div class="container-fluid mx-auto">
	<h1>Formulario de marcas</h1>
		<form method="post" action="marcas.update.php" enctype="multipart/form-data">
		  	<div class="form-group">		  		
		  		<?php echo '
		  			<input type="hidden" name="id" class="form-control" id="id" aria-describedby="id" placeholder="id" value="'.$id.'" required="true">		  		
			    	<label for="marca">Marca</label>
				    <input type="text" name="marca" class="form-control" id="marca" aria-describedby="marca" value="'.$marca.'" placeholder="Nombre de la marca" required="true">			    
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