<?php  
	include "header.php";
	if (isset($_GET['vaciar'])) {
		if ($_GET['vaciar'] == 1) {
			$deposito->destroyCarrito();
		}
	}
	if (isset($_GET['eliminar']) && isset($_GET['id_producto'])) {
		if ($_GET['eliminar'] == 1) {
			if (is_numeric($_GET['id_producto'])) {
				$deposito->eliminarProductoCarrito($_GET['id_producto']);
			}
		}
	}
	if (isset($_POST['agregar'])) {
		$id_producto = $_POST['id_producto'];
		$cantidad = $_POST['cantidad'];
		$deposito->addCarrito($id_producto, $cantidad);
	}
?>
<main role="main" class="container">
	<div class="row">
		<?php  
			if(isset($_SESSION['carrito'])) :
		?>
		<div class="col-md-12">
			<table class="table">
			  <thead class="thead-darkorange">
			    <tr>
					<th scope="col">Producto</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Precio Unitario</th>
					<th scope="col" colspan="2">Subtotal</th>
			    </tr>
			  </thead>
			  <tbody>				  	
				<?php
					$total = 0; 
					foreach ($_SESSION['carrito'] as $producto) {
						echo '<tr>';
						$sql = "SELECT * FROM prodcuto WHERE id=:id_producto;";
						$producto_data = $deposito->getProductoById($producto['id_producto']);
						$producto_nombre = ucwords($producto_data->nombre);
						$cantidad = $producto['cantidad'];
						$precio_unitario = $producto_data->precio_desc;
						$subtotal = $cantidad * $precio_unitario;
						$total += $subtotal;
						echo '<td>'.$producto_nombre.'</td>';
						echo '<td>'.$cantidad.'</td>';
						echo '<td>$'.$precio_unitario.'</td>';
						echo '<td>$'.$subtotal.'</td>';
						echo '<td>
								<a class="ml-3 text-danger" href="carrito.php?id_producto='.$producto['id_producto'].'&eliminar=1">
	  				  				<i class="fa fa-window-close"></i>
  				  				</a>
			  				</td>
						';
						echo '</tr>';
					}
				 ?>
			  </tbody>
			  <tfoot>
			    <tr>
			      <td colspan="3" class="font-weight-bold">Total</td>
			      <td class="font-weight-bold text-darkorange">$<?php echo $total; ?></td>
			    </tr>
			  </tfoot>
			</table>
			<a href="carrito.php?vaciar=1" class="btn btn-warning">Vaciar carrito</a>
			<a href="clientes/comprar.php" class="btn btn-success">Comprar</a>
		</div>
		<?php 
			else:
		?>
		No hay productos en el carrito
		<?php  
			endif;
		?>
	</div>
</main>

<?php  
	include "footer.php";
?>