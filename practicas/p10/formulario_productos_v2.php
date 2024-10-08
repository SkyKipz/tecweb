<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Modificar Producto</title>
    <style type="text/css">
        ol,
        ul {
            list-style-type: none;
        }
    </style>
    <script>
        function validarFormulario() {
            // Validar nombre
            var nombre = document.getElementById("nombre").value;
            if (nombre === "" || nombre.length > 100) {
                alert("El nombre es requerido y debe tener 100 caracteres o menos.");
                return false;
            }

            // Validar marca
            var marca = document.getElementById("marca").value;
            if (marca === "") {
                alert("Debe seleccionar una marca.");
                return false;
            }

            // Validar modelo
            var modelo = document.getElementById("modelo").value;
            var modeloRegex = /^[a-zA-Z0-9\s]*$/;
            if (modelo === "" || modelo.length > 25 || !modeloRegex.test(modelo)) {
                alert("El modelo es requerido, debe ser alfanumérico (incluyendo espacios) y tener 25 caracteres o menos.");
                return false;
            }

            // Validar precio
            var precio = parseFloat(document.getElementById("precio").value);
            if (isNaN(precio) || precio <= 99.99) {
                alert("El precio es requerido y debe ser mayor a 99.99.");
                return false;
            }

            // Validar detalles
            var detalles = document.getElementById("detalles").value;
            if (detalles.length > 250) {
                alert("Los detalles deben tener 250 caracteres o menos.");
                return false;
            }

            // Validar unidades
            var unidades = parseInt(document.getElementById("unidades").value);
            if (isNaN(unidades) || unidades < 1) {
                alert("Las unidades son requeridas y deben ser mayores o iguales a 0.");
                return false;
            }

            // Validar imagen o usar ruta por defecto
            var imagen = document.getElementById("imagen").value;
            if (imagen === "") {
                document.getElementById("imagen").value = "img/img_placeholder.jpg";
            }

            // Si todas son correctas, el formulario se puede enviar
            return true;
        }
    </script>
</head>

<body>
    <h1>Modificar Producto</h1>

    <?php
    // Conexión a la base de datos
    @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

    // Comprobar la conexión
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    // Obtener la id
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        // Realizar la consulta para obtener los datos
        if ($result = $link->query("SELECT * FROM productos WHERE id = $id")) {
            $producto = $result->fetch_assoc();
            $result->free();
        }
    }

    $link->close();
    ?>

    <form action="http://localhost/tecweb/practicas/p10/update_producto.php" method="post" onsubmit="return validarFormulario()">
        <input type="hidden" name="id" value="<?= isset($producto['id']) ? $producto['id'] : '' ?>">

        <label for="nombre">Nombre del Producto (hasta 100 caracteres):</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" value="<?= isset($producto['nombre']) ? htmlspecialchars($producto['nombre']) : '' ?>" required><br><br>

        <label for="marca">Marca (seleccione una opción):</label>
        <select id="marca" name="marca" required>
            <option value="">Seleccione una marca</option>
            <option value="Logitech G" <?= (isset($producto['marca']) && $producto['marca'] == 'Logitech G') ? 'selected' : '' ?>>Logitech G</option>
            <option value="Nintendo" <?= (isset($producto['marca']) && $producto['marca'] == 'Nintendo') ? 'selected' : '' ?>>Nintendo</option>
            <option value="Apple" <?= (isset($producto['marca']) && $producto['marca'] == 'Apple') ? 'selected' : '' ?>>Apple</option>
            <option value="Adata" <?= (isset($producto['marca']) && $producto['marca'] == 'Adata') ? 'selected' : '' ?>>Adata</option>
            <option value="Razer" <?= (isset($producto['marca']) && $producto['marca'] == 'Razer') ? 'selected' : '' ?>>Razer</option>
            <option value="ASUS" <?= (isset($producto['marca']) && $producto['marca'] == 'ASUS') ? 'selected' : '' ?>>ASUS</option>
            <option value="MSI" <?= (isset($producto['marca']) && $producto['marca'] == 'MSI') ? 'selected' : '' ?>>MSI</option>
        </select><br><br>

        <label for="modelo">Modelo (alfanumérico, hasta 25 caracteres):</label>
        <input type="text" id="modelo" name="modelo" maxlength="25" value="<?= isset($producto['modelo']) ? htmlspecialchars($producto['modelo']) : '' ?>" required><br><br>

        <label for="precio">Precio (formato: 9999999.99, mayor a 99.99):</label>
        <input type="number" step="0.01" id="precio" name="precio" value="<?= isset($producto['precio']) ? $producto['precio'] : '' ?>" required><br><br>

        <label for="detalles">Detalles (hasta 250 caracteres, opcional):</label>
        <textarea id="detalles" name="detalles" maxlength="250"><?= isset($producto['detalles']) ? htmlspecialchars($producto['detalles']) : '' ?></textarea><br><br>

        <label for="unidades">Unidades (mayor o igual a 0):</label>
        <input type="number" id="unidades" name="unidades" value="<?= isset($producto['unidades']) ? $producto['unidades'] : '' ?>" required><br><br>

        <label for="imagen">Ruta de la Imagen (hasta 100 caracteres, opcional):</label>
        <input type="text" id="imagen" name="imagen" maxlength="100" value="<?= isset($producto['imagen']) ? htmlspecialchars($producto['imagen']) : '' ?>"><br><br>

        <input type="submit" value="Actualizar Producto">
    </form>
</body>
</html>
