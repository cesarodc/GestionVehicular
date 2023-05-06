$(document).ready(function () {
  // Global Settings
  let edit = false;

  // Testing Jquery
  console.log('jquery is working!');
  fetchproducts();
  $('#product-result').hide();
  //$('#product-form').hide();


  // search key type event
  $('#search').keyup(function () {
    if ($('#search').val()) {
      let search = $('#search').val();
      console.log('buscando...' + search);
      $.ajax({
        url: 'backend/sanciones-search.php',
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
                    <li><a href="#" class="product-item">${product.id_usuario}</a></li>
                     `

            
              template += `
                        <tr productId="${product.id_sanciones}">
                        <td>${product.id_sanciones}</td>
                        <td>
                          ${product.id_usuario} 

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
  /////////////////////////// Agregar Productos
  $('#product-form').submit(e => {
    e.preventDefault();
    
    //('select[name=region]').change(function(){ region = $(this).val(); console.log(region);})

    let postData = {
      correo: $('#correo').val(),
      matricula: $('#matricula').val(),
      contrasena: $('#contrasena').val(),
      nombre_completo:$('#nombre').val(),
      edad:$('#edad').val(),
      direccion:$('#direccion').val(),
      celular: $('#celular').val(),
      facultad: $('#facultad').val(),
      ocupacion: $('#ocupacion').val(),
      id_matricula_user: $('#id_matricula_user').val()
      

    }

    //console.log(postData);
    const url = edit === false ? './backend/auto_add.php' : './backend/auto-edit.php';

    $.post(url, postData, (response) => {
      console.log(response); 
      // SE REINICIA EL FORMULARIO
      $('#correo').val("");
      $('#matricula').val("");
      $('#contrasena').val("");
      $('#nombre').val("");
      $('#edad').val("");
      $('#direccion').val("");
      $('#celular').val("");
      $('#facultad').val("");
      $('#ocupacion').val("");
      $('#id_matricula_user').val("");

      // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
      let respuesta = JSON.parse(response);
      // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
      let template_bar = '';
      template_bar += `
                          <li style="list-style: none;">status: ${respuesta.status}</li>
                          <li style="list-style: none;">message: ${respuesta.message}</li>
                      `;

      // SE HACE VISIBLE LA BARRA DE ESTADO
      $('#escudo').show();
        $('#product-form').hide();
      $('#product-result').show();
      // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
      $('#container').html(template_bar);
      // SE LISTAN TODOS LOS PRODUCTOS
      fetchproducts();
      edit = false;
    });

  });
  /////////////////////////////// Fin agregar
  // Fetching products
  function fetchproducts() {
    $.ajax({
      url: 'backend/sanciones-list.php',
      type: 'GET',
      success: function (response) {
        console.log("Lista:" + response);
        const products = JSON.parse(response);
        let template = '';
        products.forEach(product => {

          template += `
                    <tr productId="${product.id_sanciones}">
                    <td>${product.id_sanciones}</td>
                    <td>
                      ${product.id_usuario} 
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
      $.post('backend/sanciones-delete.php', { id }, (response) => {
        console.log('Elemento eliminado')
        fetchproducts();
      });
    }
  });


   // EDITAR AUTO
   $(document).on('click', '.product-edit', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr('productId');
    $.post('backend/sanciones-user-single.php', { id }, (response) => {
      console.log(response)
      let product = JSON.parse(response);
      // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
      $('#mat_auto').val(product.mat_auto);
      $('#modelo').val(product.modelo);
      $('#año').val(product.año);
      $('#tipo').val(product.tipo);
      $('#marca').val(product.marca);
      
      // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
      $('#mat_auto').val(product.mat_auto);
      $('#escudo').hide();
      $('#product-form').show();

      edit = true;
      fetchproducts();
    });
  
});

  $(document).on('click', '.product-extra', (e) => {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('productId');
      $.post('backend/sanciones-user-single.php', { id }, (response) => {
        console.log(response);
        let product = JSON.parse(response);
        let description = '';
        description += '<li>ID Sancion: ' + product.id_sanciones + '</li>';
          description += '<li>Descripcion: ' + product.descripcion + '</li>';
          description += '<li>Placas: ' + product.mat_auto + '</li>';
          description += '<li>Fecha: ' + product.fecha + '</li>';

        $('#product-result').show();
        $('#container').html(description);

        fetchproducts();
      });
  });


});


