<?php  
	include "header.php";
	$admin->validar(array('Gerente'));
	$id_marca = null;
	if (isset($_GET['id_marca'])) {
		$id_marca = $_GET['id_marca'];
	}
	$sql = "DELETE FROM marca WHERE id=:id_marca";
	$stmt = $admin->con->prepare($sql);
	$stmt->bindParam(':id_marca', $id_marca);
	$stmt->execute();
	$filas_afectadas = $stmt->rowCount();
	echo "Se eliminaron ".$filas_afectadas." filas";
?>
<br/>
<a href="marcas.php">back</a>
<?php  
	include "footer.php";	
?>