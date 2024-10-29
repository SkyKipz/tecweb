<?php
    include_once __DIR__.'/database.php';

    if( isset($_POST['id']) ) {
        if ($result = $conexion->query("SELECT * FROM productos WHERE id = {$_POST['id']} AND eliminado = 0")) {
            

            $json = array();
            if ($row = mysqli_fetch_array($result)) {
                $json = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],                    
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],             
                    'imagen' => $row['imagen']
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