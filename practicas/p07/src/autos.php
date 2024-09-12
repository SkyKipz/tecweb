<?php
    $vehiculos = array(
        "ABC1234" => array(
            "Auto" => array(
                "marca" => "Honda",
                "modelo" => 2020,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Alfonzo Esparza",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "C.U., Jardines de San Manuel"
            )
        ),
        "DEF5678" => array(
            "Auto" => array(
                "marca" => "Mazda",
                "modelo" => 2019,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Ma. del Consuelo Molina",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "97 oriente"
            )
        ),
        "GHI9012" => array(
            "Auto" => array(
                "marca" => "Toyota",
                "modelo" => 2021,
                "tipo" => "hatchback"
            ),
            "Propietario" => array(
                "nombre" => "Jorge Ramírez",
                "ciudad" => "Ciudad de México",
                "direccion" => "Reforma 123"
            )
        ),
        "IKO2348" => array(
            "Auto" => array(
                "marca" => "Honda",
                "modelo" => 2020,
                "tipo" => "Civic"
            ),
            "Propietario" => array(
                "nombre" => "José Tomás",
                "ciudad" => "Guadalajara, Jalisco",
                "direccion" => "Calle Morelos 142"
            )
        ),
        "OAS4185" => array(
            "Auto" => array(
                "marca" => "Nissan",
                "modelo" => 2020,
                "tipo" => "Sentra"
            ),
            "Propietario" => array(
                "nombre" => "Francisco Mendez",
                "ciudad" => "Veracruz",
                "direccion" => "Calle Peatonal Madero 186"
            )
        ),
        "JKS8945" => array(
            "Auto" => array(
                "marca" => "Toyota",
                "modelo" => 2020,
                "tipo" => "Corolla"
            ),
            "Propietario" => array(
                "nombre" => "Melina Lopez",
                "ciudad" => "Ciudad de México",
                "direccion" => "Felipe Angeles 12"
            )
        ),
        "YPA4150" => array(
            "Auto" => array(
                "marca" => "Kia",
                "modelo" => 2020,
                "tipo" => "Forte"
            ),
            "Propietario" => array(
                "nombre" => "Luis Ramirez",
                "ciudad" => "Puebla",
                "direccion" => "Universidades 21"
            )
        ),
        "RAN7142" => array(
            "Auto" => array(
                "marca" => "Hyundai",
                "modelo" => 2021,
                "tipo" => "Elantra"
            ),
            "Propietario" => array(
                "nombre" => "Manuel Pastrana",
                "ciudad" => "Tehuacan, Pue.",
                "direccion" => "Cdad. del Sol 54"
            )
        ),
        "PQW8974" => array(
            "Auto" => array(
                "marca" => "Mazda",
                "modelo" => 2022,
                "tipo" => "3"
            ),
            "Propietario" => array(
                "nombre" => "Manuel Aguilar",
                "ciudad" => "Monterrey",
                "direccion" => "Lerma 69"
            )
        ),
        "VOL1454" => array(
            "Auto" => array(
                "marca" => "Volkswagen",
                "modelo" => 2023,
                "tipo" => "Jetta"
            ),
            "Propietario" => array(
                "nombre" => "Arturo Valencia",
                "ciudad" => "Puebla",
                "direccion" => "Calle 115 Oriente"
            )
        ),
        "JKL3456" => array(
            "Auto" => array(
                "marca" => "Ford",
                "modelo" => 2018,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Ana García",
                "ciudad" => "Monterrey, NL",
                "direccion" => "Av. Constitución 200"
            )
        ),
        "MNO7890" => array(
            "Auto" => array(
                "marca" => "Chevrolet",
                "modelo" => 2020,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Luis Pérez",
                "ciudad" => "Guadalajara, Jal.",
                "direccion" => "Av. Chapultepec 350"
            )
        ),
        "PQR2345" => array(
            "Auto" => array(
                "marca" => "Nissan",
                "modelo" => 2022,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Carlos Díaz",
                "ciudad" => "Cancún, Q. Roo",
                "direccion" => "Blvd. Kukulcán 150"
            )
        ),
        "STU6789" => array(
            "Auto" => array(
                "marca" => "Kia",
                "modelo" => 2021,
                "tipo" => "hatchback"
            ),
            "Propietario" => array(
                "nombre" => "María Fernández",
                "ciudad" => "Tijuana, BC",
                "direccion" => "Calle Segunda 340"
            )
        ),
        "VWX1234" => array(
            "Auto" => array(
                "marca" => "BMW",
                "modelo" => 2019,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Roberto Martínez",
                "ciudad" => "Querétaro, Qro.",
                "direccion" => "Av. 5 de Febrero 420"
            )
        )
        
    );

    function mostrarVehiculo($matricula, $vehiculos) {
        if (isset($vehiculos[$matricula])) {
            $auto = $vehiculos[$matricula]['Auto'];
            $propietario = $vehiculos[$matricula]['Propietario'];
            echo "<h3>Información del Vehículo</h3>";
            echo "Marca: " . $auto['marca'] . "<br>";
            echo "Modelo: " . $auto['modelo'] . "<br>";
            echo "Tipo: " . $auto['tipo'] . "<br><br>";
            echo "<h3>Información del Propietario</h3>";
            echo "Nombre: " . $propietario['nombre'] . "<br>";
            echo "Ciudad: " . $propietario['ciudad'] . "<br>";
            echo "Dirección: " . $propietario['direccion'] . "<br>";
        } else {
            echo "<h3>No se encontró información para la matrícula: $matricula</h3>";
        }
    }

    function mostrarTodos($vehiculos) {
        foreach ($vehiculos as $matricula => $info) {
            echo "<h3>Matrícula: $matricula</h3>";
            mostrarVehiculo($matricula, $vehiculos);
            echo "<hr>";
        }
    }

    if (isset($_GET['matricula']) && !empty($_GET['matricula'])) {
        $matricula = htmlspecialchars($_GET['matricula'], ENT_QUOTES, 'UTF-8');
        mostrarVehiculo($matricula, $vehiculos);
    } elseif (isset($_GET['consultar_todos'])) {
        mostrarTodos($vehiculos);
    } else {
        echo "<h3>No se proporcionó una matrícula válida.</h3>";
    }
?>
