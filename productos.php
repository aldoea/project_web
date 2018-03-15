<?php 
	include "header.php";
	include('deposito.class.php');	
	$deposito = new Deposito;
	$productos = array();
	$marca = array();
	if (isset($_GET['query'])) {
		$productos = $deposito -> getProductos($query = $_GET['query']);			
	}
	elseif (isset($_GET['marca_id'])) {
		$productos = $deposito -> getProductos($marca_id = $_GET['marca_id']);
		$marca = $deposito -> getMarcas($marca_id = $_GET['marca_id']);
	}else {
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
						    	<h5 class="card-title font-weight-bold text-capitalize">'.$productos[$i]['nombre'].'</h5>
						    	<p class="card-text product-brand text-uppercase text-warning">'.$productos[$i]['marca'].'</p>
						    	<span class="text-success font-weight-bold product-normal-price pr-3">'.$productos[$i]['precio'].'</span>
						    	<span class="text-danger product-offert-price">'.$productos[$i]['precio_desc'].'</span>
						    	<a href="#" class="btn btn-outline-light btn-outline-darkorange mt-3">Agregar al carro</a>
						  	</div>
						</div>
					</div>
				';
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