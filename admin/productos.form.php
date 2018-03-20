<?php  
	include "header.php";
?>
<div class="container-fluid mx-auto">
	<h1>Formulario de productos</h1>
		<form method="post" action="productos.save.php">
		  	<div class="form-group">
			    <label for="nombre">Nombre</label>
			    <input type="text" name="nombre" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Nombre de producto">
			    <label for="marca">Marca</label>
			    <input type="text" name="marca" class="form-control" id="marca" aria-describedby="marca" placeholder="marca">
			    <label for="precio">Precio</label>
			    <input type="text" name="precio" class="form-control" id="precio" aria-describedby="precio" placeholder="Precio"><label for="precio_desc">Precio descuento</label>
			    <input type="text" name="precio_desc" class="form-control" id="precio_desc" aria-describedby="precio_desc" placeholder="Precio de descuento">	
			    <label for="imagen">Imagen</label>
			    <input type="imagen" name="imagen" class="form-control" id="imagen" aria-describedby="imagen" placeholder="imagen">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		  	<button type="reset" class="btn btn-danger">Reset</button>
		</form>
</div>

<?php  
	include "footer.php";
?>