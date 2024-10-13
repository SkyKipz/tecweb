<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if(!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JASON A OBJETO
    $jsonOBJ = json_decode($producto);

    // VALIDACIONES
    $nombre = mysqli_real_escape_string($conexion, $jsonOBJ->nombre);
    $query = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
    $result = $conexion->query($query);
    
    if ($result->num_rows > 0) {
        echo '[SERVIDOR] Error: El producto ya existe.';
        return;
    }

    // INSERCIÓN
    $marca = mysqli_real_escape_string($conexion, $jsonOBJ->marca);
    $modelo = mysqli_real_escape_string($conexion, $jsonOBJ->modelo);
    $precio = $jsonOBJ->precio;
    $detalles = mysqli_real_escape_string($conexion, $jsonOBJ->detalles);
    $unidades = $jsonOBJ->unidades;
    $imagen = mysqli_real_escape_string($conexion, $jsonOBJ->imagen);

    $insertQuery = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                    VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
    
    if ($conexion->query($insertQuery) === TRUE) {
        echo '[SERVIDOR] Éxito: Producto agregado correctamente.';
    } else {
        echo '[SERVIDOR] Error: ' . $conexion->error;
    }

    $conexion->close();
}
?>
