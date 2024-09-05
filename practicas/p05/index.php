<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Práctica 5 - Manejo de Variables en PHP</title>
    </head>
    <body>
    <h1>Práctica 5 - Manejo de Variables en PHP</h1>

    <h2>Ejercicio 1</h2>
        <?php
            // Ejercicio 1
            $_myvar = '$_myvar válida<br>';    // La variable pueden comenzar con _
            $_7var = '$_7var  válida<br>';     // La variable pueden empezar con _
            //myvar no es válida porque falta el símbolo $
            $myvar = '$myvar válida<br>';     // Variable válida porque contiene el faltante del anterior
            $var7 = '$var7  válida<br>';      // Variable válida
            $_element1 = '$_element1 válida<br>'; // Nombre válido con _ y números
            //$house*5 no es válida porque contiene un carácter no permitido, el *
            $no_Validas = 'Las variables "myvar" y "$house*5" no son válidas<br>';

            echo $_myvar.$_7var.$myvar.$var7.$_element1.$no_Validas;
            unset ($_myvar, $_7var, $myvar, $var7, $_element1, $no_Validas);

        ?>
        
    <h2>Ejercicio 2</h2>
        <?php
            $a = "ManejadorSQL";
            $b = 'MySQL';
            $c = &$a;
            echo "a: $a<br>b: $b<br>c: $c<br>";

            echo '<br>Se realizarán cambios:<br>';
        
            $a = "PHP server";
            $b = &$a;
            echo "<br>a: $a<br>b: $b<br>c: $c<br>";
            unset($a, $b, $c);
            echo "<br>En el segundo bloque de asignaciones, la variable \$a se reasigna a \"PHP server\" y la variable \$b es una referencia a \$a, entonces también toma el valor \"PHP server\". Y \$c se mantiene sin cambios referenciando a \$a.";

        ?>

    </body>
</html>
