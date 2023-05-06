<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
    <script>
        alert("Porfavor inicie sesion");
        window.location = "index.php";
    </script>
    ';
    session_destroy();
    die();
}

//print_r ($_SESSION['ID_usuario'])
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Control Vehicular</title>
  <!-- BOOTSTRAP 4  -->
  <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

  <!-- BARRA DE NAVEGACIÓN  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" style="color:#003b5c;font-weight:bold; font-size: 25px;" href="Inicio-USER.php">Control Vehicular BUAP</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto"></ul>
      <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-warning my-2 my-sm-0" style="padding: 7px;" type="button" onclick="location.href='Perfil.php'">Mi perfil</button>
        &nbsp;
        &nbsp;
        <button class="btn btn-danger my-2 my-sm-0" style="padding: 7px;" type="button" onclick="location.href='backend/cerrar_sesion.php'">Cerrar sesión</button>
      </form>
    </div>

  </nav>

  <div align="center" class="page-content">
        <div class="option-container">
            <br>
            <a href="Mi-auto.php">MI AUTO <br><br>
            <img src="assets/images/u_1.jpg" /> </a>
        </div>

        <div align="center" class="option-container">
            <br>
            <a href="Sanciones_User.php">VER SANCIONES <br><br>
            <img src="assets/images/u_3.jpg" /> </a>
        </div>

        <div align="center" class="option-container">
            <br>
            <a href="ayuda.php">AYUDA <br><br>
            <img src="assets/images/u_4.jpg" /> </a>
        </div>

    </div>

</body>
<hr color="white">
<footer>
<br>  
    <p>Benemérita Universidad Autónoma de Puebla   <br>
        4 Sur 104 Centro Histórico C.P. 72000   <br>
        Teléfono +52 (222) 229 55 00</p>
</footer>

</html>