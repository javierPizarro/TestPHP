<html>
    <head>
        <meta charset="UTF-8">
        <title>ClearPar</title>
    </head>
    <body>
		<?php

		$obj = new ClearPar();
		$input = '()())()';
		echo 'ClearPar.build( \''.$input.'\' ) = '.$obj->build($input);
		echo '<br>';
		$input = '()(()';
		echo 'ClearPar.build( \''.$input.'\' ) = '.$obj->build($input);
		echo '<br>';
		$input = ')(';
		echo 'ClearPar.build( \''.$input.'\' ) = '.$obj->build($input);
		echo '<br>';
		$input = '((()';
		echo 'ClearPar.build( \''.$input.'\' ) = '.$obj->build($input);

		class ClearPar {

			function build($cadena) {
				$retorno = str_replace('()','*',$cadena);
				$retorno = str_replace(array('(',')'),'',$retorno);
				$retorno = str_replace('*','()',$retorno);
				return $retorno;
			}

		}
		?>
    </body>
</html>
