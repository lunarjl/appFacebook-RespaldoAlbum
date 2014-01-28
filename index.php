<?php
require_once('../../src/facebook.php');
$config = array
  (
    'appId' => 'xxxxxxxxx',
    'secret' => 'xxxxxxxxx',
  );
$fb = new facebook($config);
$parametros=array(	
	'redirect_uri'	=>	'url/procesa.php',
	'scope'			=>	'user_photos,friends_photos'
	);
$url= $fb->getLoginUrl($parametros);
?>
<html>
<head>
	<title>..::Respaldar Fotografias::..</title>

<link rel="stylesheet" type="text/css" href="css/normalize.css">
<link href='http://fonts.googleapis.com/css?family=Skranji' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<div id="header">API-Respaldo Album-</div>
	<div id="recuadro">
		<span class="titulo">App  -Respaldando ando- </span>
			<a href="<?php echo $url;?>"><button>Acceder</button></a>
		<span class="explicacion">
			Esta es una pequeña aplicacion la cual consta de poder acceder a los albumnes del usuario, para poder realizar un respaldo de los mismos, el usuario podra seleccionar de cuales se realizara la copia o respaldo de las mismas xD
		</span>
		<span class="descripcion">
			Primero deberas de darme autorizacion para poder interactuar con tu usuario de fb xD!!!!
		</span>

	</div>
	<div id="footer"></div>
</body>
</html>
