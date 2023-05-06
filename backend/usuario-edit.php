<?php
    include 'conexion_be.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id_matricula_user']) ) {
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "UPDATE usuario set  correo='$jsonOBJ->correo' ,contrasena='$jsonOBJ->contrasena', nombre_completo='$jsonOBJ->nombre_completo',edad='$jsonOBJ->edad',direccion='$jsonOBJ->direccion',celular='$jsonOBJ->celular',facultad='$jsonOBJ->facultad',ocupacion='$jsonOBJ->ocupacion' WHERE id_matricula_user='$jsonOBJ->id_matricula_user'";

        
        $conexion->set_charset("utf8");
        if ( $conexion->query($sql) ) {
            $data['status'] =  "Success";
            $data['message'] =  "Informacion de usuario actualizado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>