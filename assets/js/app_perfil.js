$(document).ready(function () {
  // Global Settings


  // Testing Jquery
  console.log('jquery is working!');
  fetchproducts();

  $('#product-form').hide();

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
  
    const url = './backend/usuario-edit.php';

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
    });

  });
  /////////////////////////////// Fin agregar
  // Fetching products
  function fetchproducts() {
    let id = $('#id').val();
    $.post('backend/product-single.php', { id }, (response) => {
      console.log(response);
      let product = JSON.parse(response);
      let description = '';
      description += '<li>Correo: ' + product.correo + '</li>';
      description += '<li>Usuario: ' + product.usuario + '</li>';
      //description += '<li>Contrasena: ' + product.contrasena + '</li>';
      description += '<li>Nombre: ' + product.nombre_completo + '</li>';
      description += '<li>Fecha de Nacimiento: ' + product.edad + '</li>';
      description += '<li>Dirección: ' + product.direccion + '</li>';
      description += '<li>Celular: ' + product.celular + '</li>';
      description += '<li>Facultad: ' + product.facultad + '</li>';
      description += '<li>Ocupación: ' + product.ocupacion + '</li>';
      $('#container').html(description);
      
    });
  }

  

  $(document).on('click', '.product-edit', (e) => {
      let id = $('#id').val();
      $.post('backend/product-single.php', { id }, (response) => {
        console.log(response)
        let product = JSON.parse(response);
        // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
        $('#correo').val(product.correo);
        $('#contrasena').val(product.contrasena);
        $('#nombre').val(product.nombre_completo);
        $('#edad').val(product.edad);
        $('#direccion').val(product.direccion);
        $('#celular').val(product.celular);
        $('#facultad').val(product.facultad);
        $('#ocupacion').val(product.ocupacion);
        
        // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
        $('#id_matricula_user').val(product.id_matricula_user);
        $('#escudo').hide();
        $('#product-form').show();
        fetchproducts();
      });
    
  });
});



