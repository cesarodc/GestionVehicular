<?php
    include 'conexion_be.php';
    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un auto con esa matricula'
    );
    if(isset($_POST['mat_auto'])) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "SELECT * FROM auto WHERE mat_auto='{$jsonOBJ->mat_auto}' AND eliminado = 0";
        $result = $conexion->query($sql);

        if ($result->num_rows == 0) {
            $conexion->set_charset("utf8");
            $sql = "INSERT INTO auto VALUES (null,'{$jsonOBJ->id_usuario}', '{$jsonOBJ->mat_auto}',  '{$jsonOBJ->modelo}', '{$jsonOBJ->año}', '{$jsonOBJ->tipo}', '{$jsonOBJ->marca}',0)";
            if($conexion->query($sql)){
                $data['status'] =  "success";
                $data['message'] =  "Auto agregado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
            }
        }

        $result->free();
        // Cierra la conexion
        $conexion->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>



