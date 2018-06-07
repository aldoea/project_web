<?php  
	include "header.php";
	$id = null;	
	if (isset($_GET['id'])) {
		if (is_numeric($_GET['id'])) {
				$id = $_GET['id'];				
			}	
	}	

	$sql = "SELECT * FROM producto where id=:id";
	$stmt = $admin->con->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();	
	$productos =(array) $stmt->fetchObject();	
	
	$nombre = isset($productos['nombre']) ? $productos['nombre']: null;
	$precio = isset($productos['precio']) ? $productos['precio'] : null;
	$precio_desc = isset($productos['precio_desc']) ? $productos['precio_desc'] : null;
	$id_marca = isset($productos['id_marca']) ? $productos['id_marca'] : null;
	$imagen = isset($productos['imagen']) ? $productos['imagen'] : null;
		
?>
<div class="container-fluid mx-auto">
	<h1>Formulario de productos</h1>
		<form method="post" action="productos.update.php" enctype="multipart/form-data">
		  	<div class="form-group">		  		
		  		<?php echo '		  		
			    <input type="hidden" name="id" class="form-control" id="id" aria-describedby="id" placeholder="id" value="'.$id.'" required="true">
			    <label for="nombre">Nombre</label>
			    <input type="text" name="nombre" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Nombre de producto" value="'.$nombre.'" required="true">
			    <label for="nombre">Marca</label>
			    '?>
			    <?php include "components/component.marcas.dropdown.php"?>
		  		<?php echo '		  		
			    <label for="precio">Precio</label>
			    <input type="number" name="precio" class="form-control" id="precio" aria-describedby="precio" placeholder="Precio" value="'.$precio.'" required="true">
			    <label for="precio_desc">Precio descuento</label>
			    <input type="number" name="precio_desc" class="form-control" id="precio_desc" aria-describedby="precio_desc" placeholder="Precio de descuento" value="'.$precio_desc.'" required="true">			    
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