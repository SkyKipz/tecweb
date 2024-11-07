<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', '12345678a', 'marketzone');
$product->search($term); // $term debe ser el término de búsqueda
echo $product->getData();
?>
