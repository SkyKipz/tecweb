<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 2</title>
</head>
<body>
    <?php
        require_once __DIR__.'/Menu.php';
        $menu1 =  new Menu;
        $menu1->cargar_opcion('https://www.facebook.com/', 'Facebook');
        $menu1->cargar_opcion('https://twitter.com/', 'Twitter');
        $menu1->cargar_opcion('https://www.instagram.com/', 'Instragram');
        $menu1->mostrar();
    ?>
</body>
</html>