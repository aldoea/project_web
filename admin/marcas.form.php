<?php  
	include "header.php";
?>
<div class="container-fluid mx-auto">
	<h1>Formulario de marcas</h1>
		<form method="post" action="marcas.save.php" enctype="multipart/form-data"> 
		  	<div class="form-group">
			    <label for="marca">Marca</label>
			    <input type="text" name="marca" class="form-control" id="marca" aria-describedby="marca" placeholder="Nombre de la marca" required="true">
			    <label for="imagen">Imagen</label>
			    <input type="file" name="imagen" class="form-control-file" id="imagen" aria-describedby="imagen" required="true">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		  	<button type="reset" class="btn btn-danger">Reset</button>
		</form>
</div>

<?php  
	include "footer.php";
?>