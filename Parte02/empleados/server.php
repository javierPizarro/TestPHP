<?php
//url para consumir web service: http://localhost/empleados/server.php?wsdl
header('Content-Type: text/html; charset=ISO-8859-1');
require_once('./libraries/nusoap2.php');
ini_set('soap.wsdl_cache_enabled', '0');
$server = new nusoap_server();
$server->configureWSDL('wsEmpleado', 'urn:wsEmpleado');

$server->register('filtroEmpleadosxSalario', array('minimo' => 'xsd:double',
    'maximo' => 'xsd:double'), //parameter
        array('xml' => 'xsd:string'), //output
        'urn:wsEmpleado', //namespace
        'urn:wsEmpleado#filtroEmpleadosxSalario' //soapaction
);

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

$server->service(file_get_contents("php://input"));
