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
    
?>