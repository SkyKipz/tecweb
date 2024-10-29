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

    // var para editar
    let edit = false;

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
                                <td>
                                    <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
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

        let finalJSON = {};
        let errores = [];

        if (!$('#name').val() || $('#name').val().length > 100) {
            errores.push('El nombre es requerido y debe tener 100 caracteres o menos.');
        } else {
            finalJSON['nombre'] = $('#name').val();
        }

        if (!$('#marca').val() || $('#marca').val().length > 50) {
            errores.push('La marca es requerida y debe tener 50 caracteres o menos.');
        } else {
            finalJSON['marca'] = $('#marca').val();
        }

        const modelo = $('#modelo').val() || '';
        if (!modelo || modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(modelo)) {
            errores.push('El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.');
        } else {
            finalJSON['modelo'] = modelo;
        }

        const precio = parseFloat($('#precio').val());
        if (!precio || precio <= 99.99) {
            errores.push('El precio es requerido y debe ser mayor a 99.99.');
        } else {
            finalJSON['precio'] = precio;
        }

        const detalles = $('#detalles').val() || '';
        if (detalles && detalles.length > 250) {
            errores.push('Si se proporcionan detalles, deben tener 250 caracteres o menos.');
        } else {
            finalJSON['detalles'] = detalles;
        }

        const unidades = parseInt($('#unidades').val());
        if (!unidades || unidades < 1) {
            errores.push('Las unidades son requeridas y deben ser mayores a 0.');
        } else {
            finalJSON['unidades'] = unidades;
        }

        const imagen = $('#imagen').val() || 'img/placeholder.jpg';
        finalJSON['imagen'] = imagen;

        if (errores.length > 0) {
            let mensajeErrores = errores.join('<br>');
            $('#container').html(`<li style="color: red;">${mensajeErrores}</li>`);
            $('#product-result').removeClass('d-none');
            return;
        }

        // Si estamos editando un producto, añadir el ID al JSON. MUY MUY IMPORTANTE 
        if (edit === true) {
            const productID = $('#productId').val();
            if (!productID) {
                errores.push('El ID del producto es requerido para la edición.');
                $('#container').html(`<li style="color: red;">${errores.join('<br>')}</li>`);
                $('#product-result').removeClass('d-none');
                return;
            }
            finalJSON['id'] = productID;
        }

        let productoJsonString = JSON.stringify(finalJSON, null, 2);

        let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

        $.ajax({
            url: url,
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

    // eliminar
    $(document).on('click', '.product-item', function () {  
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');

        $.post('./backend/product-single.php', {id}, function (response) {

            const product = JSON.parse(response);

            $('#productId').val(product.id);
            delete product.id;

            $('#name').val(product.nombre);
            delete product.nombre;

            $('#description').val(JSON.stringify(product,null,2));

            edit = true;

        });
    });

    // foco
    $(document).ready(function () {
        $('#name').on('blur', function () {
            validarNombre();
        });

        $('#marca').on('blur', function () {
            validarMarca();
        });

        $('#modelo').on('blur', function () {
            validarModelo();
        });

        $('#precio').on('blur', function () {
            validarPrecio();
        });

        $('#detalles').on('blur', function () {
            validarDetalles();
        });

        $('#unidades').on('blur', function () {
            validarUnidades();
        });
        
        function validarNombre() {
            const nombre = $('#name').val();
            if (!nombre || nombre.length > 100) {
                mostrarError('El nombre es requerido y debe tener 100 caracteres o menos.', '#name');
                return false;
            }
            limpiarError('#name');
            return true;
        }

        function validarMarca() {
            const marca = $('#marca').val();
            if (!marca) {
                mostrarError('La marca es requerida.', '#marca');
                return false;
            }
            limpiarError('#marca');
            return true;
        }

        function validarModelo() {
            const modelo = $('#modelo').val();
            if (!modelo || modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(modelo)) {
                mostrarError('El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.', '#modelo');
                return false;
            }
            limpiarError('#modelo');
            return true;
        }

        function validarPrecio() {
            const precio = parseFloat($('#precio').val());
            if (!precio || precio <= 99.99) {
                mostrarError('El precio es requerido y debe ser mayor a 99.99.', '#precio');
                return false;
            }
            limpiarError('#precio');
            return true;
        }

        function validarDetalles() {
            const detalles = $('#detalles').val();
            if (detalles && detalles.length > 250) {
                mostrarError('Los detalles deben tener 250 caracteres o menos.', '#detalles');
                return false;
            }
            limpiarError('#detalles');
            return true;
        }

        function validarUnidades() {
            const unidades = parseInt($('#unidades').val());
            if (!unidades || unidades < 1) {
                mostrarError('Las unidades son requeridas y deben ser mayores a 0.', '#unidades');
                return false;
            }
            limpiarError('#unidades');
            return true;
        }

        function mostrarError(mensaje, campo) {
            $(campo).next('.error-message').remove(); 
            $(campo).after(`<span class="error-message" style="color: red;">${mensaje}</span>`);
        }
    
        function limpiarError(campo) {
            $(campo).next('.error-message').remove();
        }
    });
});
