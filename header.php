<?php  
	include('deposito.class.php');	
	$deposito = new Deposito;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Depósito del Hogar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="shortcut icon" href="https://cdn4.iconfinder.com/data/icons/unigrid-flat-buildings/90/008_015_warehouse_building_depot_storehouse_storage_4-512.png">	
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>		
		<!-- HEADER SECTION -->		
		<header id="super_header" class="container-fluid bg-darkorange">
			<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-0">
		      	<h5 class="my-0 mr-md-auto font-weight-bold">Deposito del hogar</h5>
		      	<?php  
		      		if (!isset($_SESSION['validado'])) :
		      	?>
		      	<nav class="my-2 my-md-0 mr-md-3">		        
			        <a class="p-2 dark-link" href="clientes/login.php">Iniciar sesión</a>
	    		</nav>
			    <a class="btn btn-outline-light" href="clientes/registrarse.php">Registro</a>
			    <?php 
			    	else:
			     ?>
			    <a class="btn btn-outline-light" href="clientes/logout.php">Salir</a>
			    <?php  
			    	endif;
			    ?>
		    </header>	
			<div class="row">
				<img id="header_img" src="images/header.jpg">
			</div>
		</header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">		      	      
		      <li class="nav-item">
		        <a class="nav-link" href="proyectos.php">Proyectos</a>
		      </li>
		      		   
		      <li class="nav-item">
		        <a class="nav-link" href="productos.php">Productos</a>
		      </li>
		      
		      <li class="nav-item">
		        <a class="nav-link" href="marcas.php">Marcas</a>
		      </li>
		      <li class="nav-item">
		       	<a class="nav-link" href="contacto.php">Contacto</a>
		      </li>
		    </ul>
		    <a class="nav-link" href="carrito.php">
		    	<span class="text-warning">
		    		<i class="fas fa-shopping-cart"></i>	
		    		<span class="badge text-light"><?php 
		    		if (isset($_SESSION['carrito'])) {
		    			$num_productos = 0;
		    			foreach ($_SESSION['carrito'] as $producto) {
		    				$num_productos += $producto['cantidad'];
		    			}
		    			echo $num_productos;
		    		}
		    		?></span>
		    	</span>    	        	
		    </a>
		    <form class="form-inline my-2 my-lg-0" action="productos.php">
		      <input class="form-control mr-sm-2" type="search" placeholder="Buscar productos" aria-label="Search" name="item">
		      <input class="btn btn-outline-light btn-outline-darkorange my-2 my-sm-0" type="submit" name="buscar" value="Buscar">
		    </form>
		  </div>
		</nav>
		<!-- MAIN SECTION -->
		<div class="container-fluid">
		  <div class="row">
		    <div class="col-9 p-3 mx-0">