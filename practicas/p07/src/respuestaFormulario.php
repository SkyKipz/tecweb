<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Resultado de validación</title>
    </head>
    <body>
        <h2>Resultado:</h2>
        <?php
            if (isset($_POST['edad']) && isset($_POST['sexo'])) {
                $edad = $_POST['edad'];
                $sexo = $_POST['sexo'];

                if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
                    echo "Bienvenida, usted está en el rango de edad permitido.";
                } else {
                    echo "Lo sentimos, no cumple con los requisitos.";
                }
            } else {
                echo "Error: No se recibieron todos los datos.";
            }
        ?>
    </body>
</html>
