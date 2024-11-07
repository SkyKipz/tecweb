$(document).ready(function() {
    let edit = false;
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                $('#products').html(response);
            }
        });
    }

    $('#name').on('input', function() {
        const name = $(this).val();
        if (name) {
            $.post('./backend/validate-product-name.php', { name }, function(response) {
                $('#name-status').text(response);
            });
        }
    });

    $('#product-form').submit(function(e) {
        e.preventDefault();

        const productData = {
            nombre: $('#name').val(),
            precio: $('#price').val(),
            unidades: $('#units').val(),
            modelo: $('#model').val(),
            marca: $('#brand').val(),
            detalles: $('#details').val(),
            id: $('#productId').val()
        };

        const url = edit ? './backend/product-edit.php' : './backend/product-add.php';

        $.post(url, productData, function(response) {
            $('#product-result').show().text(response);
            $('#product-form')[0].reset();
            listarProductos();
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', function(e) {
        
        e.preventDefault();
    
        // Obtener el elemento correctamente y verificar si existe
        const element = $(this).closest('tr'); // Encuentra el elemento padre <tr> más cercano

        const id = element.attr('productId'); // Obtener el ID del producto de atributo 'productId'
    
        if (id) {
            if (confirm('¿Realmente deseas eliminar el producto?')) {
                $.post('./backend/product-delete.php', { id }, function(response) {
                    alert(response);
                    listarProductos();
                });
            }
        } else {
            console.error("Error: no se pudo obtener el ID del producto.");
        }
    });

    $(document).on('click', '.product-item', function(e) {
        e.preventDefault();
    
        // Encuentra el elemento <tr> más cercano que contiene el 'productId'
        const element = $(this).closest('tr');
        const id = element.attr('productId'); // Obtiene el 'productId' desde el atributo en <tr>
    
        $.post('./backend/product-single.php', { id }, function(response) {
            // Verificar si la respuesta contiene un error
            if (response.startsWith("Error")) {
                alert(response); // Muestra el mensaje de error si lo hay
                return;
            }
    
            // Dividir la respuesta en partes usando "|" como delimitador
            const productData = response.split('|');
    
            // Rellena los campos del formulario con los datos del producto
            $('#name').val(productData[0]);
            $('#price').val(productData[1]);
            $('#units').val(productData[2]);
            $('#model').val(productData[3]);
            $('#brand').val(productData[4]);
            $('#details').val(productData[5]);
            $('#productId').val(productData[6]);
            
            edit = true;
        });
    });
    
    
    $('#search').keyup(function() {
        const search = $(this).val();
        if (search) {
            $.get(`./backend/product-search.php?search=${search}`, function(response) {
                $('#products').html(response);
            });
        } else {
            listarProductos();
        }
    });
});
