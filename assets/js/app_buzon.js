$(document).ready(function () {

    // Testing Jquery
    console.log('jquery is working!');
    fetchproducts();
    $('#product-result').hide();

    // search key type event
    $('#search').keyup(function () {
        if ($('#search').val()) {
            let search = $('#search').val();
            console.log('buscando...' + search);
            $.ajax({
                url: 'backend/buzon-search.php',
                data: { search },
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    if (!response.error) {
                        let products = JSON.parse(response);
                        let template1 = '';
                        let template = '';
                        products.forEach(product => {
                            template1 += `
                    <li><a href="#" class="product-item">${product.asunto}</a></li>
                     `
                            template += `
                                        <tr productId="${product.id_ayuda}">
                                        <td>${product.id_usuario}</td>
                                        <td>
                                            ${product.asunto} 
                                        </td>
                                        <td>
                                            ${product.fecha} 
                                        </td>
                                        <td>
                                        <button class="product-extra btn btn-success">
                                        Mostrar
                                        </button>
                                        </td>
                                        <td>
                                        <button class="product-delete btn btn-danger">
                                        Eliminar
                                        </button>
                                        </td>
                                        </tr>
                                `
                        });
                        //console.log(response);
                        $('#product-result').show();
                        $('#container').html(template1);
                        //console.log(template);
                        $('#products').html(template);
                    }
                }
            })
        }
    });

    // Fetching products
    function fetchproducts() {

        $.ajax({
            url: 'backend/buzon-list.php',
            type: 'GET',
            success: function (response) {
                console.log("Lista:" + response);
                const products = JSON.parse(response);
                let template = '';
                products.forEach(product => {

                    template += `
                      <tr productId="${product.id_ayuda}">
                      <td>${product.id_usuario}</td>
                      <td>
                        ${product.asunto} 
                      </td>
                      <td>
                        ${product.fecha} 
                      </td>
                      <td>
                      <button class="product-extra btn btn-success">
                      Mostrar
                     </button>
                      </td>
                      <td>
                      <button class="product-delete btn btn-danger">
                      Eliminar
                     </button>
                      </td>
                    </tr>
                    `
                });
                $('#products').html(template);
            }
        });
    }

    // Delete a Single product
    $(document).on('click', '.product-delete', (e) => {
        if (confirm('¿ESTAS SEGURO DE ELIMIAR ESTE PRODUCTO?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('backend/buzon-delete.php', { id }, (response) => {
                console.log('Elemento eliminado')
                $('#product-result').hide();
                fetchproducts();
            });
        }
    });


    // MOSTRAR
    $(document).on('click', '.product-extra', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('backend/buzon-single.php', { id }, (response) => {
            console.log(response);
            let product = JSON.parse(response);
            let description = '';
            description += '<li>ID Ayuda: ' + product.id_ayuda + '</li>';
            description += '<li>Asunto: ' + product.asunto + '</li>';
            description += '<li>Descripcion: ' + product.descripcion + '</li>';
            
            description += '<li>ID Usuario: ' + product.id_usuario + '</li>';
            description += '<li>Fecha: ' + product.fecha + '</li>';


            $('#product-result').show();
            $('#container').html(description);

            fetchproducts();
        });
    });

});