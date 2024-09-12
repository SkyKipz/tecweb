<?php
    function esMultiploDe5y7($num) {
        if ($num % 5 == 0 && $num % 7 == 0) {
            return true;
        } else {
            return false;
        }
    }

    function generarSecuencia()
    {
        $secuencia = [];
        $iteraciones = 0;
        $cantidadNumeros = 0;
        
        while (true) {
            $fila = [];
            $fila[] = rand(1, 1000); 
            $fila[] = rand(1, 1000); 
            $fila[] = rand(1, 1000); 

            $iteraciones++;
            $cantidadNumeros += 3;
            
            if ($fila[0] % 2 != 0 && $fila[1] % 2 == 0 && $fila[2] % 2 != 0) {
                $secuencia[] = $fila;
                break;
            }
            
            $secuencia[] = $fila;
        }

        echo "<h3>Secuencia obtenida:</h3>";
        foreach ($secuencia as $fila) {
            echo implode(", ", $fila) . "<br>";
        }
        echo "$cantidadNumeros números en $iteraciones iteraciones.";
    }

    function encontrarMultiploWhile($numero) {
        $encontrado = false;
        $contador = 0;
        
        while (!$encontrado) {
            $aleatorio = rand(1, 1000);
            $contador++;
            if ($aleatorio % $numero == 0) {
                $encontrado = true;

                echo 'While:<br>';
                echo "Número aleatorio múltiplo de $numero encontrado: $aleatorio<br>";
                echo "Total de interaciones: $contador<br><br>";
            }
        }
    }

    function encontrarMultiploDoWhile($numero) {
        $contador = 0;
        
        do {
            $aleatorio = rand(1, 1000);
            $contador++;
        } while ($aleatorio % $numero != 0);
        
        echo 'Do while:<br>';
        echo "Número aleatorio múltiplo de $numero encontrado: $aleatorio<br>";
        echo "Total de iteraciones: $contador<br><br>";
    }
    
    function ASCII() {
        $arreglo = [];
        
        for ($i = 97; $i <= 122; $i++) {
            $arreglo[$i] = chr($i); 
        }
        
        echo "<table border='1'>";
        echo "<tr><th>Índice</th><th>Valor</th></tr>";
        foreach ($arreglo as $llave => $valor) {
            echo "<tr><td>$llave</td><td>$valor</td></tr>";
        }
        echo "</table>";
    }
    
    
    
?>