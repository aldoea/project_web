<?php  
	include "header.php";
	$id = null;
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$filas_afectadas = $admin -> deleteProducto($id);
	echo "Se eliminaron ".$filas_afectadas." filas";
?>
<button role="button" class="btn btn-primary" href="productos.php"></button>
<?php  
	include "footer.php";	
?>