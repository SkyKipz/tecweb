<?php
    if (isset($_GET['valor1'])) {
        echo "Sí se recibió y el valor es: " . $_GET['valor1'];
    } else {
        echo "No se envió ningún valor";
    }
?>
