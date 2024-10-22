// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/placeholder.jpg"
};

function init() {
    // Convierte el JSON a string para poder mostrarlo
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
}

$(document).ready(function() {
    init();
    // se mueve del init para acá
    listarProductos();

    // listar 
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                let productos = JSON.parse(response);
                let template = '';

                productos.forEach(producto => {
                    if (producto.eliminado == 0) {
                        let descripcion = `
                            <li>precio: ${producto.precio}</li>
                            <li>unidades: ${producto.unidades}</li>
                            <li>modelo: ${producto.modelo}</li>
                            <li>marca: ${producto.marca}</li>
                            <li>detalles: ${producto.detalles}</li>
                        `;
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    }
                });
                $('#products').html(template);
            }
        });
    }

    // agregar
    $('#product-form').on('submit', function(e) {
        e.preventDefault();

        var productoJsonString = $('#description').val();
        
        var finalJSON = JSON.parse(productoJsonString);
        
        let errores = [];

        if (!$('#name').val() || $('#name').val().length > 100) {
            errores.push('El nombre es requerido y debe tener 100 caracteres o menos.');
        } else {
            finalJSON['nombre'] = $('#name').val();
        }

        if (!finalJSON['marca']) {
            errores.push('La marca es requerida.');
        }

        const modelo = finalJSON['modelo'] || '';
        if (!modelo || modelo.length > 25 || !/^[a-zA-Z0-9]+$/.test(modelo)) {
            errores.push('El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.');
        } else {
            finalJSON['modelo'] = modelo;
        }

        const precio = parseFloat(finalJSON['precio']);
        if (!precio || precio <= 99.99) {
            errores.push('El precio es requerido y debe ser mayor a 99.99.');
        }

        const detalles = finalJSON['detalles'] || '';
        if (detalles && detalles.length > 250) {
            errores.push('Si se proporcionan detalles, deben tener 250 caracteres o menos.');
        }

        const unidades = parseInt(finalJSON['unidades']);
        if (!unidades || unidades < 1) {
            errores.push('Las unidades son requeridas y deben ser mayores a 0.');
        }

        const imagen = finalJSON['imagen'];
        finalJSON['imagen'] = imagen || 'img/placeholder.jpg';

        if (errores.length > 0) {
            let mensajeErrores = errores.join('<br>');
            $('#container').html(`<li style="color: red;">${mensajeErrores}</li>`);
            $('#product-result').removeClass('d-none'); 
            return; // para que no se envien las cosas
        }

        productoJsonString = JSON.stringify(finalJSON, null, 2);

        $.ajax({
            url: './backend/product-add.php',
            type: 'POST',
            contentType: "application/json;charset=UTF-8",
            data: productoJsonString,
            success: function(response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">${respuesta.status}</li>
                    <li style="list-style: none;">${respuesta.message}</li>
                `;

                $('#product-result').removeClass('d-none'); 
                $('#container').html(template_bar);

                listarProductos();
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición: ", error);
            }
        });
    });



    // borrar
    $(document).on('click', '.product-delete', function() {
        if (confirm("De verdad deseas eliminar el Producto")) {
            let id = $(this).closest('tr').attr('productId');

            $.ajax({
                url: './backend/product-delete.php',
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    let respuesta = JSON.parse(response);

                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;

                    $('#product-result').removeClass('d-none');
                    $('#container').html(template_bar);

                    listarProductos();
                }
            });
        }
    });

    // buscar
    $('#search').on('keyup', function() {
        let search = $(this).val();

        if (search !== '') {
            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: { search: search },
                success: function(response) {
                    let productos = JSON.parse(response);
                    let template = '';
                    let nombresProductos = '';

                    productos.forEach(producto => {
                        if (producto.eliminado == 0) {
                            let descripcion = `
                                <li>precio: ${producto.precio}</li>
                                <li>unidades: ${producto.unidades}</li>
                                <li>modelo: ${producto.modelo}</li>
                                <li>marca: ${producto.marca}</li>
                                <li>detalles: ${producto.detalles}</li>
                            `;
                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td>${producto.nombre}</td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-delete btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            `;
                            nombresProductos += `${producto.nombre}, `;
                        }
                    });

                    $('#products').html(template);

                    if (nombresProductos) {
                        nombresProductos = nombresProductos.slice(0, -2);
                        let statusMessage = `
                            <li style="list-style: none;">Productos encontrados: ${nombresProductos}</li>
                        `;
                        $('#container').html(statusMessage);
                    } else {
                        $('#container').html('<li style="list-style: none;">No se encontraron productos</li>');
                    }

                    $('#product-result').removeClass('d-none');
                }
            });
        } else {
            listarProductos();
            $('#product-result').addClass('d-none');
        }
    });

});
