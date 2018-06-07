<?php  
	include "header.php";
	$admin->validar(array('Gerente'));
	$id = null;
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$filas_afectadas = $admin -> deleteProducto($id);
	echo "Se eliminaron ".$filas_afectadas." filas";
?>
<br/>
<a href="productos.php">back</a>
<?php  
	include "footer.php";	
?>