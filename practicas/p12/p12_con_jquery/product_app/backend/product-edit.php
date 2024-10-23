<?php
    include_once __DIR__.'/database.php';

    $producto = file_get_contents('php://input');

    if (!empty($producto)) {
        $jsonOBJ = json_decode($producto);

        $camposFaltantes = [];

        if (!isset($jsonOBJ->id)) {
            $camposFaltantes[] = 'id';
        }
        if (!isset($jsonOBJ->nombre)) {
            $camposFaltantes[] = 'nombre';
        }
        if (!isset($jsonOBJ->marca)) {
            $camposFaltantes[] = 'marca';
        }
        if (!isset($jsonOBJ->modelo)) {
            $camposFaltantes[] = 'modelo';
        }
        if (!isset($jsonOBJ->precio)) {
            $camposFaltantes[] = 'precio';
        }
        if (!isset($jsonOBJ->detalles)) {
            $camposFaltantes[] = 'detalles';
        }
        if (!isset($jsonOBJ->unidades)) {
            $camposFaltantes[] = 'unidades';
        }
        if (!isset($jsonOBJ->imagen)) {
            $camposFaltantes[] = 'imagen';
        }

        if (count($camposFaltantes) > 0) {
            $data['status'] = "error";
            $data['message'] = "Faltan los siguientes campos en el JSON: " . implode(', ', $camposFaltantes);
        } else {

            $stmt = $conexion->prepare("UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? WHERE id = ?");
            $stmt->bind_param(
                "sssdssii", 
                $jsonOBJ->nombre, 
                $jsonOBJ->marca, 
                $jsonOBJ->modelo, 
                $jsonOBJ->precio, 
                $jsonOBJ->detalles, 
                $jsonOBJ->unidades, 
                $jsonOBJ->imagen, 
                $jsonOBJ->id
            );

            if ($stmt->execute()) {
                $data['status'] = "success";
                $data['message'] = "Producto actualizado";
            } else {
                $data['status'] = "error";
                $data['message'] = "Error al actualizar el producto: " . $stmt->error;
            }

            $stmt->close();
        }

        $conexion->close();
    } else {
        $data['status'] = "error";
        $data['message'] = "No se recibió el JSON.";
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
?>
