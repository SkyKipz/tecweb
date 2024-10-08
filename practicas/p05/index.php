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
        <p>
            <?php
                // Ejercicio 1
                $_myvar = '$_myvar válida<br />';    // La variable pueden comenzar con _
                $_7var = '$_7var  válida<br />';     // La variable pueden empezar con _
                //myvar no es válida porque falta el símbolo $
                $myvar = '$myvar válida<br />';     // Variable válida porque contiene el faltante del anterior
                $var7 = '$var7  válida<br />';      // Variable válida
                $_element1 = '$_element1 válida<br />'; // Nombre válido con _ y números
                //$house*5 no es válida porque contiene un carácter no permitido, el *
                $no_Validas = 'Las variables "myvar" y "$house*5" no son válidas<br />';

                echo $_myvar.$_7var.$myvar.$var7.$_element1.$no_Validas;
                unset ($_myvar, $_7var, $myvar, $var7, $_element1, $no_Validas);

            ?>
        </p>
    <h2>Ejercicio 2</h2>
        <p>
            <?php
                $a = "ManejadorSQL";
                $b = 'MySQL';
                $c = &$a;
                echo "a: $a<br />b: $b<br />c: $c<br />";

                echo '<br />Se realizarán cambios:<br />';
            
                $a = "PHP server";
                $b = &$a;
                echo "<br />a: $a<br />b: $b<br />c: $c<br />";
                unset($a, $b, $c);
                echo "<br />En el segundo bloque de asignaciones, la variable \$a se reasigna a \"PHP server\" y la variable \$b es una referencia a \$a, entonces también toma el valor \"PHP server\". Y \$c se mantiene sin cambios referenciando a \$a.";

            ?>
        </p>

    <h2>Ejercicio 3</h2>
        <p>
            <?php
                $a = "PHP5";
                echo "a: $a<br />";
                var_dump($a);

                $z[] = &$a;
                echo "<br />z: $z<br />";
                print_r($z);

                $b = "5a version de PHP";
                echo "<br />b: $b<br />";
                var_dump($b);

                $c = $b * 10;
                echo "<br />c: $c<br />";
                var_dump($c);

                $a .= $b;
                echo "<br />a: $a<br />";
                var_dump($a);//Es una cadena más larga, agregando lo que tiene b

                $b *= $c;
                echo "<br />b: $b<br />";
                var_dump($b); //Pasó a ser un int

                $z[0] = "MySQL";
                echo "<br />z: $z<br />";
                print_r($z);
            ?>
        </p>

    <h2>Ejercicio 4</h2>
        <p>
            <?php
                echo "Variable \$a usando \$GLOBALS: " . $GLOBALS['a'] . "<br />";
                echo "Variable \$b usando \$GLOBALS: " . $GLOBALS['b'] . "<br />";
                echo "Variable \$c usando \$GLOBALS: " . $GLOBALS['c'] . "<br />";
                echo "Variable \$z usando \$GLOBALS: ";
                print_r($GLOBALS['z']);

                unset($GLOBALS['a'], $GLOBALS['b'], $GLOBALS['c'], $GLOBALS['z']); //Nota importante, si las usas con la matriz $GLOBALS y después liberamos estas mismas, la variable solita como $a también se libera
                
            ?>
        </p>

    <h2>Ejercicio 5</h2>
        <p>
            <?php
                $a = "7 personas";
                $b = (integer) $a;
                $a = "9E3";
                $c = (double) $a;
                echo "a: $a<br />";
                var_dump($a);
                echo "<br />b: $b<br />";
                var_dump($b);
                echo "<br />c: $c<br />";
                var_dump($c);
                unset($a, $b, $c);
            ?>
        </p>

    <h2>Ejercicio 6</h2>
        <p>
            <?php
                $a = "0";
                $b = "TRUE";
                $c = FALSE; // No se puede imprimir con un echo
                $d = ($a OR $b);
                $e = ($a AND $c); // No se puede imprimir con un echo
                $f = ($a XOR $b);
                echo "a: $a<br />";
                var_dump($a);
                echo "<br />b: $b<br />";
                var_dump($b);
                echo "<br />c: $c<br />";
                var_dump($c);
                echo "<br />d: $d<br />";
                var_dump($d);
                echo "<br />e: $e<br />";
                var_dump($e);
                echo "<br />f: $f<br />";
                var_dump($f);
                echo '<br />';

                echo "Se puede mostrar usando un (int) seguido de la variable, por ejemplo (int)\$c<br />c: " . (int)$c . ", e: " . (int)$e;

                unset($a, $b, $c, $d, $e, $f);
            ?>
        </p>

    <h2>Ejercicio 7</h2>
        <p>
            <?php
                echo "Versión de Apache y PHP: " . $_SERVER['SERVER_SOFTWARE'] . "<br />";
                echo "Sistema operativo del servidor: " . PHP_OS . "<br />";
                echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br />";
                unset($_SERVER);
            ?>
        </p>
    
    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer"><img
        src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>
    </body>
</html>
