<?php 
	include('deposito.class.php');	
	$deposito = new Deposito;
	$marcas = $deposito -> getMarcas();
	echo "<pre>";
	print_r($marcas)
 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Depósito del Hogar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
	<!--<div id="father">-->
	<div id="father" class="container-fluid mx-0 px-0">
		<!-- HEADER SECTION -->
		<!-- <header id="super_header"> -->
		<header id="super_header" class="container-fluid">
			<div class="container-fluid">
				<nav class="row">
					<ul>
						<li><a href="sistema/registro.php">Registro</a></li>
						<li><a href="sistema/login.php">Iniciar sesión</a></li>						
					</ul>
				</nav>
			</div>
			<div class="row">
				<img id="header_img" src="images/header.jpg">
			</div>
		</header>
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
		      <input class="form-control mr-sm-2" type="search" placeholder="Buscar marcas" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
		    </form>
		  </div>
		</nav>
		<div class="container-fluid">
		  <div class="row">
		    <div class="col-9">
				<section>
					<article>
						<h1>Listado de marcas</h1>						
						<?php  
							$counter = 0;
							$product_len = count($marcas);
							
							if ($product_len != 3) {
								$residual = 3 - ($product_len % 3);	
							}else{
								$residual = 0;
							}

							for ($i=0; $i < count($marcas); $i++) { 
								if ($i%3 == 0) {
									echo '<div class="row">';
								}
								$marca = '
									<div class="col-sm">
										<img class="img-fluid img-thumbnail" src="images/'.$marcas[$i]['imagen'].'" alt="desarmador_truper">
										<span class="normal_price">'.$marcas[$i]['marca'].'</span>
										<span class="offert_price">'.$marcas[$i]['cantidad'].'</span>
									</div>
								';
								echo $marca;
								$counter += 1;
								
								if ($i == count($marcas) - 1 and $residual != 0) {
									for ($j=0; $j < $residual ; $j++) { 
											echo '<div class="col-sm"> </div>';
									}	
								}

								if ($counter == 3) {
									echo "</div>";
									$counter = 0;
								}
							}
						?>	
					</article>
				</section>
		    </div>
		    <div id="publicidad" class="col-3">		      
				<img src="images/paint_promotions.gif"/>
				<!--<img src="images/paint_promotions.gif"/>-->
		    </div>
		  </div>		  
		</div>
		

		<!-- FOOTER SECTION -->
		<footer>
			<!--<div id="footer_main">-->
			<div>
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
		
		<!-- MAIN SECTION 
		<main></main>
		<footer></footer>
		FOOTER SECTION -->		
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>