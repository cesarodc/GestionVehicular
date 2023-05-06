<?php
    include 'conexion_be.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id_sanciones']) ) {
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql2 = "SELECT id_auto FROM `auto` WHERE mat_auto='{$jsonOBJ->mat_auto}'";
            $id_auto=mysqli_fetch_array($conexion->query($sql2));
            $sql3 = "SELECT id_usuario FROM `auto` WHERE mat_auto='{$jsonOBJ->mat_auto}'";
            $id_user=mysqli_fetch_array($conexion->query($sql3)); 
    

            $fecha = date('d/m/y');


        $sql = "UPDATE sanciones set descripcion='$jsonOBJ->descripcion', id_auto='$id_auto[0]', mat_auto='$jsonOBJ->mat_auto', id_usuario='$id_user[0]', id_dasu='$jsonOBJ->id_dasu', fecha='$fecha' WHERE id_sanciones='$jsonOBJ->id_sanciones'";

        
        $conexion->set_charset("utf8");
        if ( $conexion->query($sql) ) {
            $data['status'] =  "Success";
            $data['message'] =  "Informacion de auto actualizado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>