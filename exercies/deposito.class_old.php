<?php 
	/**
	* Clase principal del sistema Deposito del Hogar
	*/
	class Deposito
	{
		/*
		function __construct(argument)
		{
			# code...
		}
		*/		
		public function getProductos()
		{
			$productos = array();
			/*$productos = array(
				array(
					'id' => 1,
					'nombre' => 'Pinzas de punta',
					'marca' => 'Truper',
					'imagen' => 'pinzas_punta.jpg',
					'precio' => 80,
					'precio_desc' => 60
				),
				array(
					'id' => 2,
					'nombre' => 'Desarmador',
					'marca' => 'Truper',
					'imagen' => 'desarmador.jpg',
					'precio' => 60,
					'precio_desc' => 40
				),
				array(
					'id' => 3,
					'nombre' => 'Lijadora',
					'marca' => 'Truper',
					'imagen' => 'lijadora.jpeg',
					'precio' => 600,
					'precio_desc' => 500
				),
				array(
					'id' => 4,
					'nombre' => 'Lol',
					'marca' => 'Mcguiness',
					'imagen' => 'desarmador.jpg',
					'precio' => 10000,
					'precio_desc' => 9999
				),
				array(
					'id' => 5,
					'nombre' => 'SOUThSIDE',
					'marca' => 'CJ',
					'imagen' => 'desarmador.jpg',
					'precio' => 9999,
					'precio_desc' => 99
				)
			);*/
			$products_file = fopen("productos.txt", 'r');
			$keys = array("id", "nombre", "marca", "imagen", "precio", "precio_desc");
			while (!feof($products_file)) {
				$line = fgets($products_file);
				array_push($productos, array_combine($keys, explode("|", $line)));				
			}
			return $productos;
		} # END getProductos()
	} # END class Deposito
 ?>