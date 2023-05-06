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

//print_r ($_SESSION['ID_admin']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Perfil</title>
  <!-- BOOTSTRAP 4  -->
  <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

  <!-- BARRA DE NAVEGACIÓN  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" style="color:#003b5c;font-weight:bold; font-size: 25px;" href="Inicio-ADMIN.php">Mi Perfil</a>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto"></ul>
      <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-info my-2 my-sm-0" style="padding: 7px;" type="button" onclick="location.href='Inicio-USER.php'">Regresar</button>
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
          <img style="width: 300px; height: 380px; " src="assets/images/buapo.jpg" id="escudo">
            <!-- FORMULARIO PARA AGREGAR PRODUCTO -->
            <form id="product-form">
              <div class="form-group">
              <input type="hidden" class="form-control" placeholder="Correo" id="correo" name="correo" required>
              </div>
              <div class="form-group">
               <h6>Contraseña</h6> 
              <input type="password" class="form-control" placeholder="Contraseña" name="Contrasena" id="contrasena" required>
              </div>
              <div class="form-group">
              <input type="hidden" class="form-control" placeholder="Nombre Completo" name="nombre" id="nombre" required>
              </div>
              <div class="form-group">
              <input type="hidden" class="form-control" placeholder="Edad" name="edad" id="edad" required>
              </div>
              <div class="form-group">
              <h6>Dirección</h6>
              <input type="text" placeholder="Dirección" name="direccion" class="form-control" id="direccion" required>
              </div>
              <div class="form-group">
              <h6>Celular</h6>
              <input type="text" placeholder="Celular" class="form-control" id="celular" name="celular" required>
              </div>
              <div class="form-group">
              <h6>Facultad</h6>
              <input type="text" placeholder="Facultad" class="form-control" id="facultad" name="facultad" required>
              </div>
              <div class="form-group">
              <h6>Ocupacion</h6>
              <input type="text" placeholder="Ocupacion" class="form-control" id="ocupacion" name="ocupacion" required>
              </div>
              <input type="hidden" id="id_matricula_user" value="">

            
              <button class="btn btn-primary btn-block text-center"  type="submit">
                Guardar
              </button>
            </form>
          </div>
        </div>
      </div>

      
      <!-- TABLA  -->
      <div class="col-md-7">
        <div class="card my-4" id="product-result">
          <div class="card-body">
            <!-- RESULTADO -->
            <input type="hidden" id="id" value="<?php print_r($_SESSION['ID_user']); ?>">
            <h1 align="center">Informacion de Cuenta</h1>
            <ul id="container"></ul>
            <div id="botonera" align="center">
                <button class="product-edit btn btn-info" id="edit"> Editar Informacion</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  <!-- Lógica del Frontend -->
  <script src="assets/js/app_perfil.js"></script>
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