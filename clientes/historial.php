<?php 
	include "header.php";
	$admin->validar(array('Cliente'));
	$details_flag = false;
	if (isset($_GET['id_carrito'])) {		
		$id_carrito = $_GET['id_carrito'];
		$sql = 'SELECT c.id_carrito, concat(x.nombre, " " ,apaterno, " " ,amaterno) AS nombre, fecha, cd.id_producto, p.nombre AS producto, cd.cantidad, cd.precio_final, (cd.precio_final * cd.cantidad) AS monto from carrito c JOIN cliente x ON c.id_cliente = x.id_cliente JOIN carrito_detalle cd ON c.id_carrito = cd.id_carrito join producto p ON p.id = cd.id_producto WHERE c.id_carrito = :id_carrito;';
		$stmt = $admin->con->prepare($sql);
		$stmt->bindParam(':id_carrito', $id_carrito);
		$stmt->execute();
		$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}
	
	$id_cliente = $admin->getClienteId();
	$sql = 'SELECT 
				c.id_carrito, 
			    c.fecha
			FROM 
				carrito c 
			JOIN 
				carrito_detalle cd 
			ON
				c.id_carrito = cd.id_carrito 
			WHERE 
				c.id_cliente=1';
	$stmt = $admin->con->prepare($sql);		
	$stmt->bindParam(':id_cliente', $id_cliente);
	$stmt->execute();
	$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
	?>

 <main role="main" class="container">
 	<div class="row mt-3">
 		<?php 
 			if (isset($detalles)>0)  :
 		 ?> 		
 		<div class="col-md-12">
 			<table class="table">
 			  <thead class="thead-darkorange">
 			  	<tr>
 			  		<th>Producto</th>
 			  		<th>Cantidad</th>
 			  		<th>Precio Final</th>
 			  		<th>Monto</th>
 			  	</tr>
 			  </thead>
 			  <tbody>				  	
 				<?php
 					$total = 0; 
 					foreach ($detalles as $compra) {
 						echo '<tr>
 							<td>'.$compra['producto'].'</td>
 							<td>'.$compra['cantidad'].'</td>
 							<td>'.$compra['precio_final'].'</td>
 							<td>'.$compra['monto'].'</td>
 						</tr>';
 						$total += $compra['monto'];
 					}
					echo '<tr>
						<td colspan="3" class="font-weight-bold">Total</td>
						<td class="font-weight-bold text-darkorange">$'.$total.'</td>
					</tr>';
 				 ?>
 			  </tbody>
 			</table>
 			<a href="historial.php">Back
 				<i class="fas fa-back"></i>
 			</a>
 		</div>
 	<?php else: ?>
 		<div class="col-md-12">
 			<table class="table">
 			  <thead class="thead-darkorange">
 			  	<tr> 			  		
 			  		<th>#</th> 			  		
 			  		<th colspan="2">Fecha</th>
 			  	</tr>
 			  </thead>
 			  <tbody>				  	
 				<?php
 					$counter = 0; 
 					foreach ($historial as $compra) {
 						$counter += 1;
 						echo '<tr>
 							<td>'.$counter.'</td> 							
 							<td>'.$compra['fecha'].'</td>
 							<td>
 								<a href="historial.php?id_carrito='.$compra['id_carrito'].'"><i class="fas fa-info-circle"></i>Detalles</a>
 								<a class="ml-3" href="imprimir.php?id_carrito='.$compra['id_carrito'].'"><i class="fas fa-print text-info"></i>Imprimir factura</a>
							</td>
 						</tr>';
 					}
 				 ?>
 			  </tbody>
 			</table>
 		</div>
 	<?php endif; ?>
 	</div>
 </main>

 <?php 
 	include "footer.php";
 ?>