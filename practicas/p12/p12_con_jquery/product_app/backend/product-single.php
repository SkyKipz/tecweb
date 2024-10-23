<?php
    include_once __DIR__.'/database.php';

    if( isset($_POST['id']) ) {
        if ($result = $conexion->query("SELECT * FROM productos WHERE id = {$_POST['id']} AND eliminado = 0")) {
            

            $json = array();
            if ($row = mysqli_fetch_array($result)) {
                $json = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'marca' => $row['marca'],
                    'precio' => $row['precio'],
                    'detalles' => $row['detalles'],
                    'unidades' => $row['unidades'],
                    'imagen' => $row['imagen'],
                    'modelo' => $row['modelo']
                );
            } else {
                $json = null;
            }
            


            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
    }
    $conexion->close();
    
    echo json_encode($json, JSON_PRETTY_PRINT);


?>