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

		public function getProductos($marca_id = null, $query = null)
		{
			$productos = array();	
			$condicion = "";
			if ($marca_id != null) {
				$condicion = "where marca.id_marca = $marca_id";
			}
			if ($query != null) {
				$condicion = "where (productos.nombre like '%$q%' or marcas.marca like '%$q%')";
			}
			if ($marca_id != null  && $query != null) {
				$condicion = "where productos.nombre like '%$q%' and marca.id_marca = $marca_id";
			}

			$this -> conexion();
			if( $resultado = $this -> con -> query("select producto.id, producto.nombre, producto.imagen, producto.precio, producto.precio_desc, producto.id_marca, marca.marca from producto inner join marca on producto.id_marca = marca.id $condicion order by producto.nombre;")) {				
				while ($datos = $resultado -> fetch_object()) {						
					array_push($productos, (array)$datos);
				}
				$resultado -> close();
			}
			return $productos;
		} # END getProductos()

		public function getMarcas($marca_id = null)
		{
			$condicion = "";			
			if ($marca_id != null) {
				$condicion = "where marca.id = $marca_id GROUP by 1,2 limit 1";
			}
			$marcas = array();			
			$this -> conexion();
			if( $resultado = $this -> con -> query("select marca.id, marca.marca, marca.imagen, count(producto.id) as cantidad from marca join producto on marca.id = producto.id_marca $condicion;")){
				while ($datos = $resultado -> fetch_object()) {					
					array_push($marcas, (array)$datos);
				}
				$resultado -> close();
			}
			return $marcas;
		} # END getMarcas()

		public function getPublicidad()
		{
			$publicidad = array();
			$this -> conexion();
			$sql = "SELECT * FROM publicidad WHERE fecha >= now() order by rand() limit 1";
			if ($resultado = $this -> con -> query($sql)) {
				while ($datos = $resultado -> fetch_object()) {
					$publicidad = array('id' => $datos ->id, 'publicidad' => $datos->publicidad, 'imagen' => $datos->imagen, 'fecha' => $datos->fecha);
				}
				return $publicidad;
			}
		} # END getPublicidad()


		public function getProyectos($proyecto_id=null)
		{
			$proyectos = array();
			$this -> conexion();
			$sql = "SELECT * FROM proyecto WHERE fecha >= now()";
			if ($resultado = $this -> con -> query($sql)) {
				while ($datos = $resultado -> fetch_object()) {
					array_push($proyectos, (array)$datos);
				}				
				return $proyectos;
			}
		} # END getProyectos()

		public function getProductosDeProyecto($proyecto_id=null)
		{
			$productos = array();
			$condicion = "";
			$this -> conexion();
			if ($proyecto_id != null) {
				$condicion = "where pro.id=$proyecto_id";
			}
			$sql = "SELECT p.nombre from producto p inner join producto_proyecto pp on p.id=pp.id_producto inner join proyecto pro on pp.proyecto_id=pro.id $condicion";
			if ($resultado = $this -> con -> query($sql)) {
				while ($datos = $resultado -> fetch_object()) {
					array_push($productos, (array)$datos);
				}				
				return $productos;
			}
		}


		public function deleteProducto($id_producto)
		{
			if (is_numeric($id_producto)) {
				$sql = "delete from producto where producto.id=".$id_producto;
				$this -> con -> query($sql);
				return $this->con->affected_rows;
			}
			return 0;
		}

	} # END class Deposito
 ?>