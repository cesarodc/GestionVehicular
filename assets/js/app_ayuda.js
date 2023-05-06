 /////////////////////////// Agregar Productos
 $('#ayuda-form').submit(e => {
    e.preventDefault();
    
    //('select[name=region]').change(function(){ region = $(this).val(); console.log(region);})

    let postData = {
      asunto: $('#asunto').val(),
      id_usuario: $('#id_user').val(),
      descripcion: $('#descripcion').val(),
    }

    console.log(postData);
  
    const url = './backend/ayuda-add.php';

    $.post(url, postData, (response) => {
      console.log(response); 
      // SE REINICIA EL FORMULARIO
      $('#asunto').val("");
      $('#descripcion').val("");

      alert('En un lapso de 3 dias habiles tendra una resolucion que sera comunicada a su correo')
    });

  });