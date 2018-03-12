<?php 
	$materias = array(
										'14030557' => array(
																				array(
																					'materia' => 'PrograWeb',
																					'calificacion' => 100
																				),
																				array(
																					'materia' => 'Redes de Computadora',
																					'calificacion' => 90
																				),
																				array(
																					'materia' => 'Progra ClienteServidor',
																					'calificacion' => 80
																				),
																				array(
																					'materia' => 'Ingles7',
																					'calificacion' => 70
																				)
																			),
										'14030657' => array(
																				array(
																					'materia' => 'PrograWeb',
																					'calificacion' => 70
																				),
																				array(
																					'materia' => 'Redes de Computadora',
																					'calificacion' => 80
																				),
																				array(
																					'materia' => 'Progra ClienteServidor',
																					'calificacion' => 90
																				),
																				array(
																					'materia' => 'Ingles7',
																					'calificacion' => 100
																				)
																			),
										'14030333' => array(
																				array(
																					'materia' => 'PrograWeb',
																					'calificacion' => 60
																				),
																				array(
																					'materia' => 'Redes de Computadora',
																					'calificacion' => 50
																				),
																				array(
																					'materia' => 'Progra ClienteServidor',
																					'calificacion' => 70
																				),
																				array(
																					'materia' => 'Ingles7',
																					'calificacion' => 80
																				)
																			)	
									);
	echo "<pre>";
	echo "<h1>Estrucura Orginal</h1>";
	print_r($materias);

	$calificaciones = array();

	foreach ($materias as $alumno => $alum_materias) {
		foreach ($alum_materias as $materia) {
			$materia_name = '';
			foreach ($materia as $key => $value) {
				if ($key == 'materia') {
					$materia_name = $value;					
				}else{
					$calificaciones[$materia_name][$alumno] = $value;
				}
			} # FOREACH $materia
		} # FOREACH $alum_materias
	} # FOREACH
	echo "<h1>Estrucura Reorganizada</h1>";
	print_r($calificaciones);

	echo "<h1>Resultados</h1>";
	echo "<table border=1>";
	echo "<thead><tr><th>Materia</th><th>CalificacionMayor</th><th>Alumno</th><th>CalificacionMenor</th><th>Alumno</th><th>Diferencia</th><th>PromedioDeMateria</th></tr></thead>";

	foreach ($calificaciones as $key => $value) {
		asort($calificaciones[$key], SORT_NUMERIC);
		$keys = array_keys($calificaciones[$key]);
		echo "<tr>";
		echo "<td>";
		echo $key;
		echo "</td>";
		echo "<td>";
		echo end($calificaciones[$key]);
		echo "</td>";
		echo "<td>";
		echo end($keys);
		echo "</td>";	
		echo "<td>";
		echo reset($calificaciones[$key]);
		echo "</td>";
		echo "<td>";
		echo reset($keys);
		echo "</td>";			
		echo "<td>";
		echo end($calificaciones[$key]) - reset($calificaciones[$key]);
		echo "</td>";
		echo "<td>";
		echo array_sum($calificaciones[$key]) / count($calificaciones[$key]);
		echo "</td>";
	}
	echo "</table>";	
?>