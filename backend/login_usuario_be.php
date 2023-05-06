<?php
session_start();
include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
//$contrasena = hash('sha512',$contrasena);

//Validacion de USUARIO 
$validar_loginUsuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario='$correo' and contrasena='$contrasena' and eliminado=0 and verificado=1");

//Validacion de DASU
$validar_loginDASU = mysqli_query($conexion,"SELECT * FROM dasu WHERE usuario='$correo' and contrasena='$contrasena' and eliminado=0");

//Validacion de ADMIN

$validar_loginADMIN= mysqli_query($conexion,"SELECT * FROM adminstrador WHERE usuario='$correo' and contrasena='$contrasena' and eliminado=0");


$data=[];

if(mysqli_num_rows($validar_loginUsuario)>0){
    $result = $conexion->query("SELECT id_matricula_user FROM usuario WHERE usuario='$correo' and contrasena='$contrasena'");
    $row = $result->fetch_assoc();
    foreach($row as $key => $value) {
        $data[$key] = utf8_encode($value);
    }
    $result->free();
    $_SESSION['usuario'] =$correo;
    $_SESSION['ID_user'] =$data['id_matricula_user'];
    header("location: ../Inicio-USER.php");
    exit;
} elseif(mysqli_num_rows($validar_loginDASU)>0){
    $result = $conexion->query("SELECT id_matricula_dasu FROM dasu WHERE usuario='$correo' and contrasena='$contrasena'");
    $row = $result->fetch_assoc();
    foreach($row as $key => $value) {
        $data[$key] = utf8_encode($value);
    }
    $result->free();
    $_SESSION['dasu'] =$correo;
    $_SESSION['ID_dasu'] =$data['id_matricula_dasu'];
    header("location: ../Inicio-DASU.php");
    exit;
} elseif(mysqli_num_rows($validar_loginADMIN)>0){
    $result = $conexion->query("SELECT id_matricula_admin FROM adminstrador WHERE usuario='$correo' and contrasena='$contrasena'");
    $row = $result->fetch_assoc();
    foreach($row as $key => $value) {
        $data[$key] = utf8_encode($value);
    }
    $result->free();
    $_SESSION['admin'] =$correo;
    $_SESSION['ID_admin'] =$data['id_matricula_admin'];
    header("location: ../Inicio-ADMIN.php");
    exit;
}
else{
    echo'
    <script>
        alert("El correo no existe o la contraseña es incorrecta, porfavor verifica los datos ingresados");
        window.location = "../index.php";
    </script>
    ';
    exit;
}

?>