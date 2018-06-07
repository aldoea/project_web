<?php 
	include "header.php";
	$productos = array();
	$marca = array();
	if (isset($_GET['query'])) {
		$productos = $deposito -> getProductos($query = $_GET['query']);			
	}
	elseif (isset($_GET['id_marca'])) {
		if (is_numeric($_GET['id_marca'])) {
			$id_marca = $_GET['id_marca'];
			$productos = $deposito -> getProductosByIdMarca($id_marca);
			$marca = $deposito -> getProductosByIdMarca($id_marca);
		}
	}
	elseif (isset($_GET['buscar'])) {
		if (!is_null($_GET['item'])) {
			$productos = $deposito -> searchProductos($_GET['item']);
		}
	}
	else {
		$productos = $deposito -> getProductos();
	}

 ?>
<section>
	<article>
		<h1>Listado de productos</h1>						
		<?php
			if (isset($_GET['marca_id']) && !empty($marca)) {
			  echo '<div class="row mx-auto px-auto">
			  			<img src="images/marcas/'.$marca[0]['imagen'].'" class="img-fluid" alt="'.$marca[0]['marca'].'_logo">
		  			</div>
			  ';	
		  	}  
			$counter = 0;
			$product_len = count($productos);
			$products_per_row = 4;
			
			if ($product_len != $products_per_row) {
				$residual = $products_per_row - ($product_len % $products_per_row);	
			}else{
				$residual = 0;
			}

			for ($i=0; $i < count($productos); $i++) { 
				if ($i%$products_per_row == 0) {
					echo '<div class="row mx-2 py-3">';
				}
				$producto = '
					<div class="col">
						<div class="card">
							<img class="card-img-top" src="images/productos/'.$productos[$i]['imagen'].'" alt='.$productos[$i]['nombre'].'_'.$productos[$i]['marca'].'">
						  	<div class="card-body">
						    	<h5 class="card-title text-capitalize">'.$productos[$i]['nombre'].'</h5>
						    	<p class="card-text product-brand text-uppercase text-warning">'.$productos[$i]['marca'].'</p>
						    	<span class="text-success font-weight-bold product-normal-price pr-auto">$'.$productos[$i]['precio_desc'].'</span>
						    	<span class="text-danger text-mistake">$'.$productos[$i]['precio'].'</span>
						    	<a href="producto.php?id_producto='.$productos[$i]['id'].'" class="btn btn-outline-light btn-outline-darkorange mt-3">Ver producto</a>
						  	</div>
						</div>
					</div>
				';
				if (!$productos[$i]['precio_desc']) {
					$producto = '
						<div class="col">
							<div class="card">
								<img class="card-img-top" src="images/productos/'.$productos[$i]['imagen'].'" alt='.$productos[$i]['nombre'].'_'.$productos[$i]['marca'].'">
							  	<div class="card-body">
							    	<h5 class="card-title text-capitalize">'.$productos[$i]['nombre'].'</h5>
							    	<p class="card-text product-brand text-uppercase text-warning">'.$productos[$i]['marca'].'</p>
							    	<span class="text-success font-weight-bold product-normal-price pr-auto">$'.$productos[$i]['precio'].'</span>
							    	<a href="producto.php?id_producto='.$productos[$i]['id'].'" class="btn btn-outline-light btn-outline-darkorange mt-3">Ver producto</a>
							  	</div>
							</div>
						</div>
					';
				}
				
				echo $producto;
				$counter += 1;
				
				if ($i == count($productos) - 1 and $residual != 0) {
					for ($j=0; $j < $residual ; $j++) { 
						echo '<div class="col"> </div>';
					}	
				}

				if ($counter == $products_per_row) {
					echo "</div>";
					$counter = 0;
				}
			}
		?>	
	</article>
</section>
<?php  
	include "footer.php"
?>