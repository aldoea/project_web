<?php  
	include "header.php";
?>
<div class="container-fluid mx-auto">
	<h1>Formulario de productos</h1>
		<form method="post" action="productos.save.php" enctype="multipart/form-data"> 
		  	<div class="form-group">
			    <label for="nombre">Nombre</label>
			    <input type="text" name="nombre" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Nombre de producto" required="true">
			    <label for="marca">Marca</label>	
			   	<?php include "components/component.marcas.dropdown.php"; ?>			    
			    <label for="precio">Precio</label>
			    <input type="number" name="precio" class="form-control" id="precio" aria-describedby="precio" placeholder="Precio" required="true">
			    <label for="precio_desc">Precio descuento</label>
			    <input type="number" name="precio_desc" class="form-control" id="precio_desc" aria-describedby="precio_desc" placeholder="Precio de descuento" required="true">	
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