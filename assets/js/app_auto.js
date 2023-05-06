$(document).ready(function () {
    // Global Settings
    let edit = false;
  
    // Testing Jquery
    console.log('jquery is working!');
    fetchproducts();
    
    $('#product-form').hide();
    
    $('#auto-form').hide();
    $('#auto-result').hide();
  
    // search key type event
    $('#search').keyup(function () {
      if ($('#search').val()) {
        let search = $('#search').val();
        let id = $('#id_usuario').val();
        console.log('buscando...' + search + ' ID '+ id );
        $.ajax({
          url: 'backend/auto-search.php',
          data: { search, id},
          type: 'GET',
          success: function (response) {
            console.log(response);
            if (!response.error) {
              let products = JSON.parse(response);
              let template1 = '';
              let template = '';
              products.forEach(product => {
                template1 += `
                      <li><a href="#" class="product-item">${product.mat_auto}</a></li>
                     `
                 template += `
                          <tr productId="${product.id_auto}">
                          <td>${product.mat_auto}</td>
                          <td>
                            ${product.modelo} 
  
                          </td>
                       
                        <td>
                        <button class="product-qr btn btn-success">
                        Generar
                        </button>
                        </td>
                        <td>
                      <button class="product-extra btn btn-success">
                      Mostrar
                     </button>
                      </td>
                      <td>
                      <button class="product-edit btn btn-info">
                      Editar
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
    /////////////////////////// EDITAR AUTOS
    $('#product-form').submit(e => {
      e.preventDefault();
      
      //('select[name=region]').change(function(){ region = $(this).val(); console.log(region);})
  
      let postData = {
        mat_auto: $('#mat_auto').val(),
        modelo: $('#modelo').val(),
        año: $('#año').val(),
        tipo:$('#tipo').val(),
        marca:$('#marca').val(),
        id_usuario: $('#id_usuario').val()
          
      }
      //console.log("EDIT O ADD");
      //console.log(postData);
      const url = edit === false ? './backend/auto_add.php' : './backend/auto-edit.php';
  
      $.post(url, postData, (response) => {
        console.log(response); 
        // SE REINICIA EL FORMULARIO
        $('#mat_auto').val("");
        $('#modelo').val("");
        $('#año').val("");
        $('#tipo').val("");
        $('#marca').val("");
  
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
    /////////////////////////////// Fin 
    // Fetching products
    function fetchproducts() {
      let id = $('#id_usuario').val();
      console.log(id);
      $.ajax({
        url: 'backend/auto-list.php',
        data: { id },
        type: 'GET',
        success: function (response) {
          console.log("Lista:" + response);
          const products = JSON.parse(response);
          let template = '';
          products.forEach(product => {
  
            template += `
                      <tr productId="${product.id_auto}">
                      <td>${product.mat_auto}</td>
                      <td>
                        ${product.modelo} 
                      </td>
                        <td>
                        <button class="product-qr btn btn-success">
                        Generar
                        </button>
                        </td>
                      <td>
                      <button class="product-extra btn btn-success">
                      Mostrar
                     </button>
                      </td>
                      <td>
                      <button class="product-edit btn btn-info">
                      Editar
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
        console.log('id='+ id)
        $.post('backend/auto-delete.php', { id }, (response) => {
          console.log('Elemento eliminado')
          fetchproducts();
        });
      }
    });
  // EDITAR AUTO
    $(document).on('click', '.product-edit', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('backend/auto-single.php', { id }, (response) => {
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
  // PARA MOSTRAR AUTOS
    $(document).on('click', '.product-extra', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('backend/auto-single.php', { id }, (response) => {
          console.log(response);
          let product = JSON.parse(response);
          let description = '';
          description += '<li>Placas: ' + product.mat_auto + '</li>';
          description += '<li>Modelo: ' + product.modelo + '</li>';
          description += '<li>Año: ' + product.año + '</li>';
          description += '<li>Tipo: ' + product.tipo + '</li>';
          description += '<li>Marca: ' + product.marca + '</li>';
  
          $('#product-result').show();
          $('#container').html(description);
  
          fetchproducts();
        });
    });



    $(document).on('click', '.product-qr', (e) => {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('productId');
      $.post('backend/auto-single.php', { id }, (response) => {
        console.log(response);
        let product = JSON.parse(response);
        let description = '';
        const hoy = new Date();
        description += '[{"Usuario":%20"' + product.id_usuario + '"%20},';
        description += '{"Placas":%20"' + product.mat_auto + '"%20},';
        description += '{"Modelo":%20"' + product.modelo + '"%20},';
        description += '{"Anio":%20"' + product.año + '"%20},';
        description += '{"Tipo":%20"' + product.tipo + '"%20},';
        description += '{"Marca":%20"' + product.marca + '"%20},';
        description += '{"Fecha":%20"' + hoy.toLocaleDateString()+ '"}]';

        

        console.log(description);
        img = '<img src= https://api.qrserver.com/v1/create-qr-code/?data='+ description +'&size=220x220  alt="QR"/>';
        $('#product-result').show();
        $('#container').html(img);

        fetchproducts();
      });
  });
  
  
  });

  // PARA AGREGAR AUTOS
   /*
    /////////////////////////// AGREGAR AUTOS
    $('#auto-form').submit(e => {
        e.preventDefault();
       
        let postData = {
          mat_auto: $('#mat_auto').val(),
          modelo: $('#modelo').val(),
          año: $('#año').val(),
          tipo:$('#tipo').val(),
          marca:$('#marca').val(),
          id_usuario: $('#id_usuario').val()
            
        }
    
        //console.log(postData);
        const url = './backend/auto_add.php';
    
        $.post(url, postData, (response) => {
          console.log(response); 
          // SE REINICIA EL FORMULARIO
          $('#mat_auto').val("");
          $('#modelo').val("");
          $('#año').val("");
          $('#tipo').val("");
          $('#marca').val("");
          $('#id_usuario').val("");
    
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
            $('#auto-form').hide();
          $('#auto-result').show();
          // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
          $('#container').html(template_bar);
          // SE LISTAN TODOS LOS PRODUCTOS
          fetchautos();
        });
    
      });
      /////////////////////////////// Fin 
*/
  $(document).on('click', '.product-add', (e) => {
      $('#escudo').hide();
      $('#product-form').show();
    });
  




  
