<html>
    <head>
        <meta charset="UTF-8">
        <title>CompleteRange</title>
    </head>
    <body>
		<?php

		$obj = new CompleteRange();
		$array = array(1, 2, 4, 5);
		echo '{'.implode(",", $array).'} = {'.implode(',',$obj->build(array(1, 2, 4, 5))).'}';
		echo '<br>';
		$array = array(2, 4, 9);
		echo '{'.implode(",", $array).'} = {'.implode(',',$obj->build($array)).'}';
		echo '<br>';
		$array = array(55, 58, 60);
		echo '{'.implode(",", $array).'} = {'.implode(',',$obj->build($array)).'}';

		class CompleteRange {

			function build($coleccion) {
				$cantidad = count($coleccion);
				$completo = array();
				if ($cantidad > 2) {
					$completo = array($coleccion[0]);
					for ($i = 0; $i < $cantidad - 1; $i++) {
						$rango = range($coleccion[$i]+1, $coleccion[$i + 1]);
						$completo = array_merge($completo, $rango);
					}
					return $completo;
				} else {
					return $coleccion;
				}
			}

		}
		?>
    </body>
</html>
