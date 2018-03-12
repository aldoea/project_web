<!DOCTYPE html>
<html>
<head>
	<title>calculadora</title>
</head>
<body>
	<main>
		<form method="get" action="calc.php">		  
			<input type="number" name="number1">
			<select name="operacion">
			<option value="+">+</option>								
			<option value="-">-</option>								
			<option value="*">*</option>								
			<option value="/">/</option>								
			</select>
			<input type="number" name="number2">
			<input type="submit" name="enviar" value="=">
		</form>
	</main>		
	<?php  
		if (isset($_GET["enviar"])) {
			#if ( ($_GET["number1"]!="") && ($_GET["number2"]!="")) {
			if (isset($_GET["number1"]) && isset($_GET["number2"])) {
				echo "BOOL: ";
				echo isset($_GET["number1"]);
				echo "<br/>";
				echo isset($_GET["number2"]);
				echo "<h1>Resultado</h1>";
				$number1 = $_GET["number1"];
				$number2 = $_GET["number2"];
				$operator = $_GET["operacion"];
				$resultado;

				switch ($operator) {
					case '+':
						$resultado = $number1 + $number2;
						break;
					case '-':
						$resultado = $number1 - $number2;
						break;
					case '*':
						$resultado = $number1 * $number2;
						break;
					case '/':
						$resultado = $number1 / $number2;
						break;							
				} # SWITCH
				echo "$number1 $operator $number2 = $resultado";				
			} # IF
		} # IF
	?>	
</body>
</html>