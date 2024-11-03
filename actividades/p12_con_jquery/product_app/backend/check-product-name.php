<?php
include_once __DIR__.'/database.php';  // Conexión a la BD

$nombre = $_POST['nombre'];

$data = array('exists' => false);

if (!empty($nombre)) {
    $sql = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data['exists'] = true; 
    }

    $result->free();
    $stmt->close();
    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>
