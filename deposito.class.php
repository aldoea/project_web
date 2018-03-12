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
		var $con = null;
		private function conexion(){
			$user = 'root';
			$password = '';
			$server = 'localhost';
			$bd = 'depot';
			$mysqli = new mysqli($server, $user, $password, $bd);
			$this -> con=$mysqli;
		} # END conexion()

		public function getProductos()
		{
			$productos = array();			
			$this -> conexion();
			if( $resultado = $this -> con -> query("select producto.nombre, producto.imagen, producto.precio, producto.precio_desc, producto.id_marca, marca.id, marca.marca from producto inner join marca on producto.id_marca = marca.id;")) {				
				while ($datos = $resultado -> fetch_object()) {						
					array_push($productos, (array)$datos);
				}
				$resultado -> close();
			}
			return $productos;
		} # END getProductos()

		public function getMarcas()
		{
			$marcas = array();			
			$this -> conexion();
			if( $resultado = $this -> con -> query("select marcas.id, marcas.marca, count(productos.id) as cantidad from marcas join productos on marcas.id = productos.id_marca GROUP by 1,2;")){
				while ($datos = $resultado -> fetch_object()) {
					array_push($marcas, (array)$datos);
				}
				$resultado -> close();
			}
			return $marcas;
		} # END getMarcas()

	} # END class Deposito
 ?>