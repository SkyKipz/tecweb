<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', '12345678a', 'marketzone');
$product->list();
$data = $product->getData(); 

foreach ($data as $item) {
    echo "
        <tr productId='{$item['id']}'>
            <td>{$item['id']}</td>
            <td><a href='#' class='product-item'>{$item['nombre']}</a></td>
            <td>{$item['detalles']}</td>
            <td><button class='product-delete btn btn-danger'>Eliminar</button></td>
        </tr>
    ";
}
?>
