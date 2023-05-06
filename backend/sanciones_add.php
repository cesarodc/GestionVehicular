<?php
    include 'conexion_be.php';
    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array(
        'status'  => 'error',
        'message' => 'Auto no registrado'
    );
    if(isset($_POST['mat_auto'])) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "SELECT * FROM auto WHERE mat_auto='{$jsonOBJ->mat_auto}' AND eliminado = 0";
        $result = $conexion->query($sql);

        


        if ($result->num_rows != 0) {

            
            $sql2 = "SELECT id_auto FROM `auto` WHERE mat_auto='{$jsonOBJ->mat_auto}'";
            $id_auto=mysqli_fetch_array($conexion->query($sql2));
            $sql3 = "SELECT id_usuario FROM `auto` WHERE mat_auto='{$jsonOBJ->mat_auto}'";
            $id_user=mysqli_fetch_array($conexion->query($sql3)); 
    

            $fecha = date('d/m/y');

            $conexion->set_charset("utf8");
            $sql = "INSERT INTO sanciones VALUES (null,'{$jsonOBJ->descripcion}','$id_auto[0]', '{$jsonOBJ->mat_auto}', '{$id_user[0]}', '{$jsonOBJ->id_dasu}', '{$fecha}',0)";


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



