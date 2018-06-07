<?php  
	include "header.php";
?>
	<section>
		<article>
			<form method="get" action="comentario_guardar.php">
			  	<div class="form-group">
				    <label for="nameInput">Nombre</label>
				    <input type="text" name="nombre" class="form-control" id="nameInput" aria-describedby="name" placeholder="Nombre" required="">
				    <label for="lastnameInput">Apellidos</label>
				    <input type="text" name="apellido" class="form-control" id="lastnameInput" aria-describedby="lastname" placeholder="Apellidos" required="">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required="">
				    <label for="telInput">Telefono</label>
				    <input type="tel" name="telefono" class="form-control" id="telInput" aria-describedby="tel" placeholder="Telefono" required="">
				</div>
			    <div class="form-group">
			       <label for="textareaInput">Comentario</label>
			       <textarea class="form-control" name="comentario" id="textareaInput" rows="3"></textarea>
		     	</div>	
			  <button type="submit" class="btn btn-success">Enviar</button>
			  <button type="reset" class="btn btn-danger">Limpiar</button>
			</form>
		</article>
	</section>
<?php  
	include "footer.php";
?>		