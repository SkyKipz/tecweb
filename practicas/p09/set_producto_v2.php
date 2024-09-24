<?php
// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['imagen'];

if (strlen($nombre) > 100 || strlen($marca) > 25 || strlen($modelo) > 25 || strlen($detalles) > 250 || strlen($imagen) > 100) {
    die("Error: uno o más campos exceden el tamaño máximo permitido.");
}

$query = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "El producto ya existe en la base de datos.";
} else {
    
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

    if ($stmt->execute()) {
        echo "<h1>Producto registrado con éxito</h1>";
        echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
        echo "Marca: " . htmlspecialchars($marca) . "<br>";
        echo "Modelo: " . htmlspecialchars($modelo) . "<br>";
        echo "Precio: $" . htmlspecialchars($precio) . "<br>";
        echo "Detalles: " . htmlspecialchars($detalles) . "<br>";
        echo "Unidades: " . htmlspecialchars($unidades) . "<br>";
        echo "Imagen: " . htmlspecialchars($imagen) . "<br>";
    } else {
        echo "Error al insertar el producto: " . $stmt->error;
    }
}

$stmt->close();
$link->close();
?>
