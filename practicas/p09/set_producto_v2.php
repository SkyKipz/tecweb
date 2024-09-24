<?php
// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['imagen'];

// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// Verificar si el producto ya existe
$sql_check = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo "El producto ya existe en la base de datos.";
} else {
    // $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
            VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen')";

    if ($link->query($sql)) {
        echo "Producto insertado con éxito. ID: " . $link->insert_id;
        echo "<br/>Nombre: $nombre<br/>Marca: $marca<br/>Modelo: $modelo<br/>Precio: $precio<br/>Detalles: $detalles<br/>Unidades: $unidades<br/>Imagen: $imagen";
    } else {
        echo "Error al insertar el producto: " . $link->error;
    }
}

// Cerrar la conexión
$link->close();
?>
