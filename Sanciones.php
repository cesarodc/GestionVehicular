<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo '
    <script>
        alert("Porfavor inicie sesion");
        window.location = "index.php";
    </script>
    ';
    session_destroy();
    die();
}

//print_r ($_SESSION['ID_admin']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Control Vehicular</title>
  <!-- BOOTSTRAP 4  -->
  <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

  <!-- BARRA DE NAVEGACIÓN  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" style="color:#003b5c;font-weight:bold; font-size: 25px;" href="Inicio-ADMIN.php">Control Vehicular BUAP</a>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto"></ul>
      <form class="form-inline my-2 my-lg-0">

        <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Buscar..." aria-label="Search">
        <button class="btn btn-primary my-2 my-sm-0" style="padding: 7px;" type="button" onclick="location.href='BuzonAyuda.php'">Buzon de Ayuda</button>
        &nbsp;
        &nbsp;
        <button class="btn btn-warning my-2 my-sm-0" style="padding: 7px;" type="button" onclick="location.href='Inicio-ADMIN.php'">Usuarios</button>
        &nbsp;
        &nbsp;
        <button class="btn btn-danger my-2 my-sm-0" style="padding: 7px;" type="button" onclick="location.href='backend/cerrar_sesion.php'">Cerrar sesión</button>
      </form>
    </div>
  </nav>



  <div class="container">
    <div class="row p-4">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
          <img style="width: 400px; height: 300px; " src="assets/images/BUAP.png" id="escudo">
          </div>
        </div>
      </div>

      
      <!-- TABLA  -->
      <div class="col-md-7">
        <div class="card my-4" id="product-result">
          <div class="card-body">
            <!-- RESULTADO -->
            <ul id="container"></ul>
          </div>
        </div>

        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <td>ID</td>
              <td>Matricula de Usuario</td>
              <td>Info_Extra</td>
            </tr>
          </thead>
          <tbody id="products"></tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  <!-- Lógica del Frontend -->
  <script src="assets/js/app_sanciones.js"></script>
</body>
<hr color="white">
<footer style="text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #003b5c;
    color: black;
    bottom: 0;
    width: 100%;
    height: 8em ;
    top: 0;
    position: relative;
    bottom: auto;">
    <br>
<p>Benemérita Universidad Autónoma de Puebla   <br>
        4 Sur 104 Centro Histórico C.P. 72000   <br>
        Teléfono +52 (222) 229 55 00</p>
</footer>

</html>