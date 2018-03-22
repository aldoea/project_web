<?php  
	include "header.php";
	$id = null;	
	if (isset($_GET['id'])) {		
		$id = $_GET['id'];
	}	
	$sql = "SELECT * FROM producto where id=$id";
	$resultado = $admin->consultar($sql);	
	$datos =(array) $resultado->fetchObject();	
	$nombre = $datos['nombre'];
	$precio = $datos['precio'];
	$precio_desc = $datos['precio_desc'];
	$id_marca = $datos['id_marca'];
	$imagen = $datos['imagen'];	
?>
<div class="container-fluid mx-auto">
	<h1>Formulario de productos</h1>
		<form method="post" action="productos.update.php">
		  	<div class="form-group">		  		
		  		<?php echo '
		  		<label for="id">ID</label>
			    <input type="hidden" name="id" class="form-control" id="id" aria-describedby="id" placeholder="id" value="'.$id.'">
			    <label for="nombre">Nombre</label>
			    <input type="text" name="nombre" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Nombre de producto" value="'.$nombre.'">
			    <label for="marca">Marca</label>
			    <input type="text" name="marca" class="form-control" id="marca" aria-describedby="marca" placeholder="marca" value="'.$id_marca.'">
			    <label for="precio">Precio</label>
			    <input type="text" name="precio" class="form-control" id="precio" aria-describedby="precio" placeholder="Precio" value="'.$precio.'">
			    <label for="precio_desc">Precio descuento</label>
			    <input type="text" name="precio_desc" class="form-control" id="precio_desc" aria-describedby="precio_desc" placeholder="Precio de descuento" value="'.$precio_desc.'">	
			    <label for="imagen">Imagen</label>
			    <input type="imagen" name="imagen" class="form-control" id="imagen" aria-describedby="imagen" placeholder="imagen" value="'.$imagen.'">
			    '?>
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		  	<button type="reset" class="btn btn-danger">Reset</button>
		</form>
</div>

<?php  
	include "footer.php";
?>