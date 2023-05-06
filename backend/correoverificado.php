<?php
include 'conexion_be.php';

$data = array();
$jsonOBJ = json_decode( json_encode($_POST) );



$consulta = mysqli_query($conexion,"SELECT * FROM usuario WHERE id_matricula_user='{$jsonOBJ->matricula}' and cv='{$jsonOBJ->codigo}'");

if(mysqli_num_rows($consulta)>0){
    mysqli_query($conexion, "UPDATE usuario SET verificado=1 WHERE id_matricula_user = {$jsonOBJ->matricula}");
    $data = "Y";
}
else{
    $data = 'N';
}

echo json_encode($data, JSON_PRETTY_PRINT);

?>