<?php
require '/vendor/autoload.php';

\Slim\Slim::registerAutoloader();
use \Slim\Slim;
// Instanciamos nuestra aplicación
$app = new Slim();

$app->map("/", function () use($app) {
     $app->render('listaempleado.php');
 })->via(['GET','POST','PUT']);
 
 $app->map("/obtener/:id", function ($id) use($app){
     $app->render('empleado.php',compact('id'));
 })->via(['GET','POST','PUT']);
 
 $app->map("/wsEmpleado/:rangoMenor/:rangoMayor", function ($rangoMenor,$rangoMayor) use($app){
	 $app->response()->header("Content-Type", "application/xml");
	 $xmlstr =filtroEmpleadosxSalario($rangoMenor,$rangoMayor);
     echo $xmlstr;
 })->via(['GET']);
 
 
 $app->run();
 
 function filtroEmpleadosxSalario($minimo, $maximo) {
    $data = file_get_contents("employees.json");
    $empleados = json_decode($data, true);
    $xml = '<xml>';
    foreach ($empleados as $empleado) {
        if(compara($empleado['salary'], $minimo, $maximo)){
            $xml = $xml . '<employee>';
            $xml = $xml . '<id>'.$empleado['id'].'</id>';
            $xml = $xml . '<isOnline>'.$empleado['isOnline'].'</isOnline>';
            $xml = $xml . '<salary>'.$empleado['salary'].'</salary>';
            $xml = $xml . '<age>'.$empleado['age'].'</age>';
            $xml = $xml . '<position>'.$empleado['position'].'</position>';
            $xml = $xml . '<name>'.$empleado['name'].'</name>';
            $xml = $xml . '<gender>'.$empleado['gender'].'</gender>';
            $xml = $xml . '<email>'.$empleado['email'].'</email>';
            $xml = $xml . '<phone>'.$empleado['phone'].'</phone>';
            $xml = $xml . '<address>'.$empleado['address'].'</address>';
            $xml = $xml . '<skills>';
            foreach ($empleado['skills'] as $skill) {
                $xml = $xml . '<skill>'.$skill['skill'].'</skill>';
            }
            $xml = $xml . '</skills>';
            $xml = $xml . '</employee>';
        }
    }
    $xml = $xml . '</xml>';
    return $xml;
}

function compara($salario, $minimo, $maximo) {
    if ($salario !== '' && $salario !== null) {
        $numero = '';
        for ($i = 0; $i < strlen($salario); $i++) {
            if (is_numeric(substr($salario, $i, 1)) || substr($salario, $i, 1) === '.') {
                $numero = $numero . substr($salario, $i, 1);
            }
        }
        if($numero>$minimo && $numero<$maximo){
            return true;
        }else{
            return false;
        }
    } else {
        return false;
    }
}