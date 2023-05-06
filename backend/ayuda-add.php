<?php
    include 'conexion_be.php';
    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un auto con esa matricula'
    );

    $jsonOBJ = json_decode( json_encode($_POST) );
    $fecha = $fecha = date('d/m/y');
        $conexion->set_charset("utf8");
        $sql = "INSERT INTO ayuda VALUES (null,'{$jsonOBJ->asunto}', '{$jsonOBJ->descripcion}',  '{$jsonOBJ->id_usuario}', '{$fecha}',0)";
        if($conexion->query($sql)){
        $data['status'] =  "success";
        $data['message'] =  "Auto agregado";
            
    } else {
        $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
    }
      
        // Cierra la conexion
    $conexion->close();
   

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>



