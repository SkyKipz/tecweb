<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', '12345678a', 'marketzone');
$productId = $_POST['id'] ?? null;

if ($productId) {
    $product->single($productId);
    $data = $product->getData();

    // Devolver los datos del producto en formato de texto separado por algún delimitador (por ejemplo, "|")
    if (!empty($data)) {
        $product = $data[0]; // Suponiendo que getData() devuelve un array con un solo producto
        echo "{$product['nombre']}|{$product['precio']}|{$product['unidades']}|{$product['modelo']}|{$product['marca']}|{$product['detalles']}|{$product['id']}";
    } else {
        echo "Error: Producto no encontrado";
    }
} else {
    echo "Error: ID de producto no proporcionado";
}
?>
?>
