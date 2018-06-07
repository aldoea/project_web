<?php  
	include "header.php";
?>
<div class="container-fluid mx-auto">
	<h1>Formulario de marcas</h1>
		<form method="post" action="proyectos.save.php" enctype="multipart/form-data"> 
		  	<div class="form-group">
			    <label>Proyecto</label>
			    <input type="text" name="proyecto" class="form-control" aria-describedby="marca" placeholder="Nombre del proyecto" required="true">
			    <label>Fecha</label>
			    <input type="date" name="fecha" class="form-control" aria-describedby="marca" placeholder="Fecha de caducidad">
			    <label>Descripción</label>
			    <textarea name="descripcion" class="form-control" placeholder="Una descripcion breve del proyecto"></textarea>
			    <label for="imagen">Imagen</label>
			    <input type="file" name="imagen" class="form-control-file" id="imagen" aria-describedby="imagen" required="true">
			</div>
			<button type="submit" class="btn btn-success">Enviar</button>
		  	<button type="reset" class="btn btn-danger">Limpiar</button>
		</form>
</div>

<?php  
	include "footer.php";
?>