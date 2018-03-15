<?php  
	include "header.php";
	$producto_id = null;
	if (isset($_GET['producto_id'])) {
		$producto_id = $_GET['producto_id'];
	}
	$filas_afectadas = $admin -> deleteProducto($producto_id);
	echo "Se eliminaron ".$filas_afectadas." afectadas";
?>
<?php  
	include "footer.php";	
?>