// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO DE BÚSQUEDA
    var searchTerm = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);

            // SE LIMPIA LA TABLA ANTES DE INSERTAR NUEVOS RESULTADOS
            document.getElementById("productos").innerHTML = '';

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (Array.isArray(productos) && productos.length > 0) {
                // SE CREA UNA PLANTILLA PARA CADA PRODUCTO
                productos.forEach(producto => {
                    let descripcion = `
                        <ul>
                            <li>precio: ${producto.precio}</li>
                            <li>unidades: ${producto.unidades}</li>
                            <li>modelo: ${producto.modelo}</li>
                            <li>marca: ${producto.marca}</li>
                            <li>detalles: ${producto.detalles}</li>
                        </ul>
                    `;

                    // SE CREA LA PLANTILLA PARA LA FILA A INSERTAR EN EL DOCUMENTO HTML
                    let template = `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${descripcion}</td>
                        </tr>
                    `;

                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    document.getElementById("productos").innerHTML += template;
                });
            } else {
                // SI NO HAY RESULTADOS, SE MUESTRA UN MENSAJE
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
            }
        }
    };
    client.send("search=" + encodeURIComponent(searchTerm));
}


// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // VALIDACIONES
    var nombre = document.getElementById('name').value.trim();

    if (!nombre || nombre.length > 100) {
        alert("El nombre es requerido y debe tener 100 caracteres o menos.");
        return;
    }
    
    finalJSON['nombre'] = nombre;

    var marca = finalJSON.marca.trim();
    if (!marca) {
        alert("La marca es requerida.");
        return;
    }

    var modelo = finalJSON.modelo.trim();
    if (!modelo || modelo.length > 25) {
        alert("El modelo es requerido y debe tener 25 caracteres o menos.");
        return;
    }

    var precio = finalJSON.precio;
    if (!precio || precio <= 99.99) {
        alert("El precio es requerido y debe ser mayor a 99.99.");
        return;
    }

    var detalles = finalJSON.detalles ? finalJSON.detalles.trim() : "";
    if (detalles.length > 250) {
        alert("Los detalles deben tener 250 caracteres o menos.");
        return;
    }
    
    var unidades = finalJSON.unidades;
    if (unidades === undefined || unidades < 0) {
        alert("Las unidades son requeridas y deben ser 0 o más.");
        return;
    }

    var imagen = finalJSON.imagen ? finalJSON.imagen.trim() : "img/placeholder.jpg";
    finalJSON['imagen'] = imagen;

    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            alert(client.responseText); 
        }
    };
    client.send(productoJsonString);
}


// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}