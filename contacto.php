<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
	<div id="father">
		<!-- HEADER SECTION -->
		<header id="super_header">
			<div>
				<nav>
					<ul>
						<li><a href="sistema/registro.php">Registro</a></li>
						<li><a href="sistema/login.php">Iniciar sesión</a></li>						
					</ul>
				</nav>
			</div>
			<div>
				<img src="images/header.jpg">
			</div>
		</header>
		<!-- <nav id="options_nav">
			<ul>
				<li><a href="index.html">Inicio</a></li>
				<li><a href="departamentos.php">Departamentos</a></li>
				<li><a href="proyectos.php">Proyectos</a></li>
				<li><a href="tiendas.html">Tiendas</a></li>
				<li><a href="promociones.html">Promociones</a></li>
			</ul>
		</nav> -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="index.html">Deposito del hogar</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">		      
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Departamentos
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#">Pintura</a>
		          <a class="dropdown-item" href="#">Jardineria</a>
		          <a class="dropdown-item" href="#">Muebles</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="#">Atención al cliente</a>
		        </div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Proyectos</a>
		      </li>
		      
		      <li class="nav-item">
		        <a class="nav-link" href="#">Tiendas</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link" href="#">Promociones</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="contacto.php">Contacto</a>
		      </li>
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Buscar productos" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
		    </form>
		  </div>
		</nav>			 	
		
		<!-- MAIN SECTION -->
		<main>
			<form method="get" action="comentario_guardar.php">
			  <div class="form-group">
			    <label for="nameInput">Nombre</label>
			    <input type="text" name="nombre" class="form-control" id="nameInput" aria-describedby="name" placeholder="Nombre">
			    <label for="lastnameInput">Apellidos</label>
			    <input type="text" name="apellido" class="form-control" id="lastnameInput" aria-describedby="lastname" placeholder="Apellidos">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">			    
			    <label for="telInput">Telefono</label>
			    <input type="tel" name="telefono" class="form-control" id="telInput" aria-describedby="tel" placeholder="Telefono">
			    <div class="form-group">
			       <label for="textareaInput">Comentario</label>
			       <textarea class="form-control" name="comentario" id="textareaInput" rows="3"></textarea>
		     	</div>	
			  <button type="submit" class="btn btn-success">Submit</button>
			  <button type="reset" class="btn btn-danger">Reset</button>
			</form>
		</main>		


		<!-- FOOTER SECTION -->
		<footer>
			<div id="footer_main">
				<aside>
					<a href='#' class='boton_rs_youtube' title='youtube'></a>
					<a href='#' class='boton_rs_twitter' title='twitter'></a>
					<a href='#' class='boton_rs_facebook' title='facebook'></a>
				</aside>
				<section>Haz más ahorrando</section>
			</div>
			<footer>
				<p>Olaya Nieto Mascarenas Salzillo, 35, 32570 Maside</p>
			</footer>
		</footer>
		
		
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>