<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Práctica 7. Ejercicio 5</title>
    </head>
    <body>
        <h2>Formulario de edad y sexo</h2>
        <form method="POST" action="http://localhost/tecweb/practicas/p07/src/respuestaFormulario.php">
        <p>
            <label for="edad">Edad:</label>
            <input type="number" name="edad" id="edad" required>
        </p>
        <p>
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" required>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
            </select>
        </p>
        <p>
            <input type="submit" value="Enviar">
            <input type="reset" value="Reiniciar">
        </p>
    </form>

    </body>
</html>