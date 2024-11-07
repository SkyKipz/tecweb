<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', '12345678a', 'marketzone');

// Definir $newProduct con los datos del formulario
$newProduct = (object) [
    'name' => $_POST['nombre'] ?? '',
    'price' => $_POST['precio'] ?? 0,
    'units' => $_POST['unidades'] ?? 0,
    'model' => $_POST['modelo'] ?? '',
    'brand' => $_POST['marca'] ?? '',
    'details' => $_POST['detalles'] ?? ''
];

$product->add($newProduct);
echo "Producto agregado exitosamente";
?>
