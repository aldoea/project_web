<?php
	$numeros[0]= 200;
	$numeros[1]= 90;
	$numeros[2]= rand(1,100000);
	$numeros[3]= 20.5;
	$numeros[4]= -8;

	//sort($numeros); existen comandos rapidos

	//Ordenamiento ascendente
	for ($i=0; $i < count($numeros); $i++) {
		for ($j= $i+1; $j < count($numeros); $j++) { 
			if($numeros[$i] > $numeros[$j])	{
				$temp= $numeros[$j];
				$numeros[$j]= $numeros[$i];
				$numeros[$i]= $temp;
			}
		}
		print ("<li>".$numeros[$i]."</li>");
	}

	echo "<br/>";

	for ($i=0; $i < count($numeros); $i++) {
		for ($j= $i+1; $j < count($numeros); $j++) { 
			if($numeros[$i] < $numeros[$j]) {
				$temp= $numeros[$i];
				$numeros[$i]= $numeros[$j];
				$numeros[$j]= $temp;
			}
		}
		print ("<li>".$numeros[$i]."</li>");
	}
?>