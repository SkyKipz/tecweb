<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Práctica 7. Ejercicio 6</title>
    </head>
    <body>
        <h2>Consulta de Vehículos</h2>

        <form method="GET" action="http://localhost/tecweb/practicas/p07/src/autos.php">
            <label for="matricula">Consultar por matrícula:</label>
            <input type="text" name="matricula" id="matricula" placeholder="LLLNNNN" />
            <input type="submit" name="consultar_matricula" value="Consultar" />
        </form>

        <form method="GET" action="http://localhost/tecweb/practicas/p07/src/autos.php">
            <input type="submit" name="consultar_todos" value="Consultar todos los vehículos" />
        </form>
    </body>
</html>
