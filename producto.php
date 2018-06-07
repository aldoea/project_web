<?php  
	include "header.php";
	$id_producto  = isset($_GET['id_producto']) ? $_GET['id_producto']:1;
	if (!is_numeric($id_producto)) {
		$id_producto=1;
	}
	$producto = $deposito->getProductoById($id_producto);
	// <p class="card-text product-brand text-uppercase text-warning">'.$producto->marca.'</p>
	$producto_html = '
		<div class="col-md-3 offset-3">
			<div class="card">
				<img class="card-img-top" src="images/productos/'.$producto->imagen.'" alt='.$producto->nombre.'">
			  	<div class="card-body">
			    	<h5 class="card-title text-capitalize">'.$producto->nombre.'</h5>	
			    	<span class="text-success font-weight-bold product-normal-price pr-auto">$'.$producto->precio.'</span>
			    	<span class="text-danger text-mistake">$'.$producto->precio_desc.'</span>			  		
			  	</div>
			  	<form method="POST" action="carrito.php">			  		
		  			<input type="number" name="cantidad" required="" class="form-control" placeholder="Cantidad" aria-label="Cantidad" aria-describedby="basic-addon2">
		  			<input type="hidden" name="id_producto" value='.$id_producto.'>
	  				<input type="submit" class="btn btn-outline-light btn-outline-darkorange btn-lg btn-block" name="agregar" value="Agregar al carrito">			  						  		
			  	</form>
			</div>
		</div>
	';
	echo $producto_html;
	include "footer.php";
?>

<!-- <form action="carrito.php" method="post">
	<input type="hidden" value='.$id_producto.' name="id_producto">
	<input type="number" name="cantidad">
	<button name="agregar" class="btn btn-outline-light btn-outline-darkorange mt-3">Agregar al carro</button>
</form> -->