<html>
    <head>
        <meta charset="UTF-8">
        <title>ChangeString</title>
    </head>
    <body>
		<?php

		$obj = new ChangeString();
		$input = '123 abcd*3';
		echo 'ChangeString.build('.$input.')='.$obj->build($input);
		echo '<br>';
		$input = '**Casa 52';
		echo 'ChangeString.build('.$input.')='.$obj->build($input);
		echo '<br>';
		$input = '**Casa 52Z';
		echo 'ChangeString.build('.$input.')='.$obj->build($input);

		class ChangeString {

			function build($cadena) {
				$decode = '';
				for ($i = 0; $i < strlen($cadena); $i++) {
					$caracter = substr($cadena, $i, 1);
					$decode = $decode . $this->codificar($caracter);
				}
				return $decode;
			}

			function codificar($caracter) {
				if ((ord($caracter) >= 65 && ord($caracter) <= 90) || (ord($caracter) >= 97 && ord($caracter) <= 122)) {
					if (ord($caracter) === 90) {
						return 'A';
					} else if (ord($caracter) === 122) {
						return 'a';
					} else {
						return chr(ord($caracter) + 1);
					}
				} else {
					return $caracter;
				}
			}

		}
		?>
    </body>
</html>
