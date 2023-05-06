<?php

include 'conexion_be.php';


$matricula = $_POST['matricula'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$direccion = $_POST['direccion'];
$celular = $_POST['celular'];
$facultad = $_POST['facultad'];
$ocupacion = $_POST['ocupacion'];

$ver = rand(100000,500000);


//contraseña encriptada con el metodo -sha512-
//$contrasena = hash('sha512', $contrasena);

$registrar = "INSERT INTO usuario(id_matricula_user,correo,contrasena,usuario,nombre_completo,edad,direccion,celular,facultad,ocupacion,cv)
VALUES('$matricula','$correo','$contrasena','$usuario','$nombre','$edad','$direccion','$celular','$facultad','$ocupacion','$ver')";

//VERIFICAR QUE EL CORREO NO SE REPITA EN LA BASE DE DATOS

$verficar_correo= mysqli_query($conexion,"SELECT * FROM usuario WHERE correo='$correo'");
if(mysqli_num_rows($verficar_correo)>0){
    echo'
    <script>
        alert("Este correo ya se ha registrado, intenta con otro correo");
        window.location = "../index.php";
    </script>
    
    ';
    exit();
}
$verficar_usuario= mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario='$usuario'");
if(mysqli_num_rows($verficar_usuario)>0){
    echo'
    <script>
        alert("Este usuario ya se ha registrado, intenta con otro usuario");
        window.location = "../index.php";
    </script>
    
    ';
    exit();
}



#CORREO ELECTRONICO
/*
$destinatario = $correo; 
$asunto = "Confirmacion de correo electronico"; 
$cuerpo = ' 
<html> 
<head> 
   <title>Confirmacion de correo electronico en el sistema de Control Vehicular BUAP</title> 
</head> 
<body> 
<h1>Código de Verificación</h1> 
<p> 
<b> 
</p> 

<footer> 
En caso de no hacer el proceso de registro en el sistema, favor de hacer caso omiso
</footer> 
</body> 
</html> 
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Sistema de Control Vehicular BUAP <systemCV@buap.mx>\r\n"; 




//mail($destinatario,$asunto,$cuerpo,$headers);
*/


$ejecutar = mysqli_query($conexion,$registrar);

if($ejecutar){
    echo'
        <script>
            alert("Usuario registrado exitosamente :D");
            window.location = "validacion.php?id='. htmlspecialchars($matricula) .'&code='.htmlspecialchars($ver).'";
        </script>
    ';
}else{
    echo'
    <script>
        alert("Parece que hubo un error :( , intentalo de nuevo");
    </script>
';
echo $registar;
echo "ERROR: No se ejecuto $registrar. " . mysqli_error($conexion);
}

mysqli_close($conexion);

?>
