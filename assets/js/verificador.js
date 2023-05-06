$(document).ready(function () {
    $(".sancion").hide();
    let mat_auto = $('#placas').val();
    if(mat_auto.length>0){
        console.log(mat_auto);
        $.post('backend/placa-single.php', { mat_auto }, (response) => {
            console.log(response);
            
                let product = JSON.parse(response);

                if(product.length != 0){
                let description = '';
                description += '<li>Matricula de Usuario: ' + product.id_usuario + '</li>';
                description += '<li>Facultad: ' + product.facultad + '</li>';
                description += '<li>Ocupacion: ' + product.ocupacion + '</li>';
                description += '<li>Celular: ' + product.celular + '</li>';
                description += '<li>Placas: ' + product.mat_auto + '</li>';
                description += '<li>Modelo: ' + product.modelo + '</li>';
                description += '<li>Año: ' + product.año + '</li>';
                description += '<li>Tipo: ' + product.tipo + '</li>';
                description += '<li>Marca: ' + product.marca + '</li>';
            
                

                
                $('#container').html(description);
                $(".sancion").show();
            }else{
                let description = '';
                description += '<h1> Auto no registrado, favor de comunicar a autoridades</h1>';
                $('#container').html(description);
            }
        });

    }



});

    

