<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        include('src/funciones.php');
        
        if (isset($_GET['numero'])) {
            $num = $_GET['numero'];

            if (esMultiploDe5y7($num)) {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            } else {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Generación repetitiva de 3 números aleatorios hasta obtener una secuencia compuesta por:<br>impar, par, impar</p>
    <?php
        generarSecuencia();
    ?>

    <h2>Ejercicio 3</h2>
    <p>Encontrar el primer número entero obtenido aleatoriamente, pero que además sea múltiplo de un número dado.</p>
    <?php 
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
            encontrarMultiploWhile($numero);
            encontrarMultiploDoWhile($numero); 
        }
        
    ?>
    
</body>
</html>