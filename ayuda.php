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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ayuda</title>
	<link rel="stylesheet" type="text/css" href="assets/css/estilo_ayuda.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
			<button class="btn btn-info my-2 my-sm-0" style="margin-top: 60px; border-radius: 10px;  padding: 6px;" type="button" onclick="location.href='Inicio-USER.php'">Regresar</button>	
			<br>
				<h2 style="margin-top:30px;">Ayuda 🤝</h2>
				<form id="ayuda-form">
				<input id="asunto" type="text" class="field" placeholder="Asunto" required>
				<input id="id_user" type="hidden" class="field" placeholder="Número de telefono" value="<?php print_r($_SESSION['ID_user']);?>">
				<textarea id="descripcion" placeholder="¿En que necesita ayuda?" class="field" required></textarea>
				<h2>Información adicional</h2>
				<ul>
					<li>Contacto DASU: 2222333445</li>
					<li>Contacto Cruz roja mexicana: +52 (222) 235 8631</li>
					<li>Servicio de Emergencias: 911</li>
				</ul>
				<button type="submit" class="btn">Enviar</button>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="assets/js/app_ayuda.js"></script>
</body>
</html>