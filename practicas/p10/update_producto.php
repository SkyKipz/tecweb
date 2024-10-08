<?php
    // Conexión a la base de datos
    $link = mysqli_connect("localhost", "root", "12345678a", "marketzone");

    // Verificar la conexión
    if($link === false){
        die("ERROR: No pudo conectarse con la base de datos. " . mysqli_connect_error());
    }

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
    $detalles = $_POST['detalles'];
    $imagen = $_POST['imagen'];

    $sql = "UPDATE productos 
            SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, unidades=$unidades, detalles='$detalles', imagen='$imagen' 
            WHERE id=$id";

    if(mysqli_query($link, $sql)){
        echo "Producto actualizado correctamente.";
    } else {
        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($link);
    }

    // Cerrar la conexión
    mysqli_close($link);
?>
