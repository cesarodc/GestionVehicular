<?php
$id= $_GET['id'];
$code = $_GET['code'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Acceso Vehicular</title>
    
    <link href="../assets/css/verificacion.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>

        <main>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <h1><?php echo $code?></h1>
                <form id="verifi">
                    <div class="contenedor1">
                        <h2>Ingrese el código de verificación enviado a su correo</h2>
                        <div class="contenedor2">
                            <div>
                                <img class="lobo" src="../assets/images/loboregistro.png">
                            </div>
                            <input type="text" placeholder="######" id="codigo" required>
                            <input type="hidden" placeholder="######" id="id" value="<?php echo $id ;?>">
                            <div>
                                <button id="boton">Verificar</button>
                            </div>
                        </div>
                        
                    </div>
                    
                </form>    
            </div>
            

        </main>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="../assets/js/app_validacion.js"></script>
</body>
</html>