$(document).ready(function () {
    $('#verifi').submit(e => {
        e.preventDefault();
        console.log('jquery is working!');
        

        let postData = {
        codigo: $('#codigo').val(),
        matricula: $('#id').val()
        }

        //console.log(postData);
        const url = '../backend/correoverificado.php';
        console.log(postData); 
        $.post(url, postData, (response) => {
        console.log(response); 
        // SE REINICIA EL FORMULARIO
        $('#codigo').val("");

        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
        let respuesta = JSON.parse(response);
        console.log(respuesta)
            if(respuesta == "Y"){
                alert("El correo se verifico correctamente :D");
                window.location = "../index.php";
            }else{
                alert("Codigo invalido, ingrese nuevamente");
            }
            console.log(respuesta)
        });
    });
});