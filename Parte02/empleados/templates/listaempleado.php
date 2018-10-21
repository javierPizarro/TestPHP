<html>
    <head>
        <title>Listado</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="POST" action=''>
            <div>  
                <div class='form-group'>
                    <label for="txtBusqueda">Busqueda: </label>
                    <input type="text" class="form-control" id="txtBusqueda" name="Busqueda" placeholder="Contenido a Buscar" />
                    <button type="submit" class="button" name='btnBusqueda' value='btnBusqueda'>Buscar</button>

                </div>
            </div>

            <div class='form-group' id='tablaEmpleados'>
                <?php
                include 'ChromePhp.php';
                $data = file_get_contents("employees.json");
                $empleados = json_decode($data, true);
                $busqueda='';
                if (isset($_POST['Busqueda'])){
                    $busqueda = $_POST['Busqueda'];
                }
                

                echo '<table style="width:100%">';
                echo '<tr><th>name</th><th>email</th> <th>position</th><th>salary</th></tr>';
                foreach ($empleados as $empleado) {
                    if ($busqueda === '' || $busqueda ===null || strpos($empleado['email'], $busqueda) !== false ) {
                        $id=$empleado['id'];
                        echo '<tr>';
                        echo '<td ><a href="/empleados/obtener/'.$id.'">' . $empleado['name'] . '</a></td>';
                        echo '<td><a href="/empleados/obtener/'.$id.'">' . $empleado['email'] . '</a></td>';
                        echo '<td><a href="/empleados/obtener/'.$id.'">' . $empleado['position'] . '</a></td>';
                        echo '<td><a href="/empleados/obtener/'.$id.'">' . $empleado['salary'] . '</a></td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
                ?>
            </div>
        </form>

    </body>
</html>