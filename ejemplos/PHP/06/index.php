<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlaces</title>
</head>
<body>
    <?php
        require_once __DIR__.'/Opcion.php';
        require_once __DIR__.'/Menu.php';

        $menu1 = new Menu('horizontal');

        $opc1 = new Opcion('Facebook', 'https://www.facebook.com/', '#4854ff');
        $opc2 = new Opcion('Outlook', 'https://www.microsoft.com/es-mx/microsoft-365/outlook/', '#66ecff');
        $opc3 = new Opcion('Instagram', 'https://www.instagram.com/', '#f69af7');

        $menu1->insertar_opcion($opc1);
        $menu1->insertar_opcion($opc2);
        $menu1->insertar_opcion($opc3);
        $menu1->graficar();
    ?>
</body>
</html>