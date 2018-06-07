<?php 
	include "header.php";
	$admin->validar(array('Cliente'));	
	if (isset($_SESSION['carrito'])) {
		if (sizeof($_SESSION['carrito']) > 0) {
			$id_carrito = $admin->compra();
			$_SESSION['id_carrito'] = $id_carrito;
		}
	}
	if (!isset($id_carrito)) {
		$id_carrito = $_SESSION['id_carrito'];
	}
 ?>
 <main role="main" class="container">
 	<div class="row mt-3">
 		<div class="col-md-12">
 			<?php 
 				echo "<h1>Gracias por comprar</h1>";
 				echo '
 				 <a href="imprimir.php?id_carrito='.$id_carrito.'">
 					 Imprimir Factura <i class="fas fa-print"></i> 	
 				 </a>
 				 <a class="text-warning ml-3" href="historial.php?id_carrito='.$id_carrito.'">
 					 Ver historial <i class="fas fa-history"></i>
 				 </a>
 				';
 			?>
 		</div>
 	</div>
 </main>

 <?php  
	include "footer.php";
 ?>