<?php 
	include "header.php";
	$marcas = $deposito -> getMarcasCountProducts();
 ?>
<section>
	<article>
		<h1>Listado de marcas</h1>
		<?php foreach($marcas as $marca):?>
			<a href="productos.php?id_marca=<?php echo $marca['id'] ?>" class="list-group-item list-group-item-action">
				<h1><?php  $marca['marca'] ?></h1>
				<img src="images/marcas/<?php echo $marca['imagen'] ?>" alt="<?php  echo $marca['marca'] ?>">
				<p>Productos disponibles: <?php echo $marca['cantidad']; ?></p>
			</a>
		<?php endforeach?>
	</article>
</section>

<?php 
	include "footer.php";
?>