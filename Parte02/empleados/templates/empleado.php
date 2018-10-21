<html>
    <head>
        <title>Empleado</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="POST" action=''>            
            <?php
            $data = file_get_contents("employees.json");
            $empleados = json_decode($data, true);

            foreach ($empleados as $empleado) {
                if ($empleado['id'] === $id) {
                    echo 'name: ' . $empleado['name'] . '<br>';
                    echo 'email: ' . $empleado['email'] . '<br>';
                    echo 'phone: ' . $empleado['phone'] . '<br>';
                    echo 'address: ' . $empleado['address'] . '<br>';
                    echo 'position: ' . $empleado['position'] . '<br>';
                    echo 'salary: ' . $empleado['salary'] . '<br>';
                    echo 'skills:<br>';
                    foreach ($empleado['skills'] as $skill) {
                        echo $skill['skill'] . '<br>';
                    }
                }
            }
            echo '<a href="/empleados">' . 'Regresar' . '</a>';
            ?>
        </form>

    </body>
</html>